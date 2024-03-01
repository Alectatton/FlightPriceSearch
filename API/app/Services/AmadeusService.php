<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class AmadeusService
{
    protected $clientId;
    protected $clientSecret;

    protected $tokenEndpoint = 'https://test.api.amadeus.com/v1/security/oauth2/token';
    protected $flightOffersEndpoint = 'https://test.api.amadeus.com/v2/shopping/flight-offers';

    public function __construct()
    {
        $this->clientId = config('services.amadeus.api_key');
        $this->clientSecret = config('services.amadeus.api_secret');
    }

    public function getFlights($startDate, $endDate, $departureAirport, $arrivalAirport, $adults=1)
    {
        $params = [
            'departureDate'           => $startDate,
            'returnDate'              => $endDate,
            'originLocationCode'      => $departureAirport,
            'destinationLocationCode' => $arrivalAirport,
            'adults'                  => $adults,
            'max'                     => 5,
        ];

        $accessToken = Cache::remember('amadeus_access_token', 600, function () {
            return $this->getAccessToken();
        });

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept'        => 'application/json',
            ])->get($this->flightOffersEndpoint, $params)->json();
        } catch (Exception $e) {
            throw new \Exception('Failed to get flights' . $e->getMessage());
        }

        $formattedResponse = $this->formatResponse($response);

        // \Log::info($formattedResponse);

        return $formattedResponse;
    }

    private function formatResponse($response): Collection
    {
        return collect($response['data'])->map(function ($flight) {
            // \Log::info($flight);
            return [
                'id'            => $flight['id'],
                'priceTotal'    => $flight['price']['total'],
                'pricePerAdult' => $flight['travelerPricings'][0]['price']['total'],
                'AirlineCodes'  => $flight['validatingAirlineCodes'],
                'departure'     => $flight['itineraries'][0]['segments'][0]['departure']['iataCode'],
                'arrival'       => $flight['itineraries'][0]['segments'][0]['arrival']['iataCode'],
                'departureTime' => $flight['itineraries'][0]['segments'][0]['departure']['at'],
                'arrivalTime'   => $flight['itineraries'][0]['segments'][0]['arrival']['at'],
                'duration'      => $flight['itineraries'][0]['duration'],
            ];
        });
    }

    private function getAccessToken(): string
    {
        $client = new Client();

        try {
            return json_decode($client->post($this->tokenEndpoint, [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'client_id'     => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type'    => 'client_credentials',
                ]
            ])->getBody())->access_token;
        } catch (GuzzleException $e) {
            throw new \Exception('Failed to get access token' . $e->getMessage());
        }
    }
}