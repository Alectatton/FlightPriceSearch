<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AmadeusService
{
    protected $clientId;
    protected $clientSecret;
    protected $accessToken;
    protected $tokenEndpoint = 'https://test.api.amadeus.com/v1/security/oauth2/token';

    public function __construct()
    {
        $this->clientId = config('services.amadeus.client_id');
        $this->clientSecret = config('services.amadeus.client_secret');

        $this->accessToken = $this->getAccessToken();
    }

    public function getFlights($startDate, $endDate, $departureAirport, $arrivalAirport)
    {


        return [
            'start_date'        => $startDate,
            'end_date'          => $endDate,
            'departure_airport' => $departureAirport,
            'arrival_airport'   => $arrivalAirport
        ];
    }

    private function getAccessToken()
    {
        return Cache::remember('amadeus_access_token', 20 * 60, function () {
            $response = Http::asForm()->post($this->tokenEndpoint, [
                'grant_type'    => 'client_credentials',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]);

            if ($response->successful()) {
                $token = $response->json()['access_token'];
                return $token;
            }

            dd($response->json());

            throw new \Exception('Failed to retrieve Amadeus access token');
        });
    }
}