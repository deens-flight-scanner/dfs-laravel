<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use Illuminate\Support\Facades\Http;

class AirportController extends Controller
{
    /**
     * Display index-page, eg general info.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        //
        return view("home");
    }

    /**
     * Search for airports that match the input
     */
    public function searchAirports($name)
    {
        $airports = Airport::where('code', 'LIKE', '%'.$name.'%')
            ->orWhere('name', 'LIKE', '%'.$name.'%')
            ->limit(5)
            ->get();

        return $airports;
    }

    /**
     * Search flights 
     */
    public function searchFlights($airport, $budget, $depart, $return, $exactDates)
    {
        // $output = new \Symfony\Component\Console\Output\ConsoleOutput();

        if ($budget === 'none') {
            $budget = '';
        }
        if ($depart === 'none') {
            $depart = '';
        }
        if ($return === 'none') {
            $return = '';
        }
        if ($exactDates === 'none') {
            $exactDates = '';
        } 
        $url = 'https://www.momondo.com/s/horizon/exploreapi/destinations?airport='.$airport.'&budget='.$budget.'&depart='.$depart.'&return='.$return.'&duration=&exactDates='.$exactDates.'&flightMaxStops=&stopsFilterActive=false&topRightLat=85.05112899999995&topRightLon=-60.02727875000227&bottomLeftLat=-80.2979267198184&bottomLeftLon=68.99615875000114&zoomLevel=1&selectedMarker=&themeCode=&selectedDestination=';
        // $url = 'https://www.momondo.com/s/horizon/exploreapi/destinations?airport='.$departure.'&budget='.$budget.'&duration=&flightMaxStops=&stopsFilterActive=false&topRightLat=83.27442317147279&topRightLon=-120.61572565507146&bottomLeftLat=-69.66682820715249&bottomLeftLon=170.47802434492354&zoomLevel=1&selectedMarker=&themeCode=&selectedDestination=';
    
        // $output->writeln($url);  
        $client = new \GuzzleHttp\Client();
        
        // Create a request
        $request = $client->get($url);
        // Get the actual response without headers
        $response = $request->getBody();

        return json_decode($response);
    }

    /**
    * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO
    }
}
