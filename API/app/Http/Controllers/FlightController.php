<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
 
class FlightController extends Controller
{

    public function index(Request $request)
    {
        // Request with "Start Date" and "End Date" parameters
        // Request also has start and ending airports
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $departureAirport = $request->input('departure_airport');
        $arrivalAirport = $request->input('arrival_airport');
    }
}