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
        $data = [
            'departureDate'           => $startDate,
            // 'end_date'                => $endDate,
            'originLocationCode'      => $departureAirport,
            'destinationLocationCode' => $arrivalAirport,
            'adults'                  => $adults,
            'max'                     => 10,
        ];

        dump($data);

        try {
            return Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Accept'        => 'application/json',
            ])->get($this->flightOffersEndpoint, $data)->json();
        } catch (Exception $e) {
            throw new \Exception('Failed to get flights' . $e->getMessage());
        }
    }

    private function getAccessToken(): string
    {
        // TODO: Cache the access token
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