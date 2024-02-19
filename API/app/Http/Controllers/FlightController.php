<?php
 
namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\AmadeusService;
 
class FlightController extends Controller
{
    protected $amadeusService;

    public function __construct(AmadeusService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function index(Request $request)
    {
        dump("HERE");

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $departureAirport = $request->input('departure_airport');
        $arrivalAirport = $request->input('arrival_airport');

        $response = $this->amadeusService->getFlights($startDate, $endDate, $departureAirport, $arrivalAirport);

        return response()->json($response);
    }
}