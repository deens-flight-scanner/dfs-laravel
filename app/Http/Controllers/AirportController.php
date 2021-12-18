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
    public function searchSuggestion($name)
    {
        $airports = Airport::where('code', 'LIKE', '%'.$name.'%')
            ->orWhere('name', 'LIKE', '%'.$name.'%')
            ->limit(5)
            ->get();

        return $airports;
    }

    /**
     * Geef laptops in de price-range
     */
    public function searchFlights($departure)
    {
        $url = 'https://www.momondo.be/s/horizon/exploreapi/destinations?airport='.$departure.'&budget=&duration=&flightMaxStops=&stopsFilterActive=false&topRightLat=83.27442317147279&topRightLon=-120.61572565507146&bottomLeftLat=-69.66682820715249&bottomLeftLon=170.47802434492354&zoomLevel=1&selectedMarker=&themeCode=&selectedDestination=';
    
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
