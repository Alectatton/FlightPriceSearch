<?php
 
namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\AmadeusService;
use Carbon\Carbon;
 
class FlightController extends Controller
{
    protected $amadeusService;

    public function __construct(AmadeusService $amadeusService)
    {
        $this->amadeusService = $amadeusService;
    }

    public function index(Request $request)
    {
        $request = $request->get('params');

        dump($request);

        $startDate = Carbon::parse($request['date_range'][0])->format('Y-m-d');
        $endDate = Carbon::parse($request['date_range'][1])->format('Y-m-d');
        $departureAirport = $request['leaving_from'];
        $arrivalAirport = $request['going_to'];
        $adults = $request['travelers'];

        $response = $this->amadeusService->getFlights($startDate, $endDate, $departureAirport, $arrivalAirport, $adults);

        return response()->json($response);
    }
}