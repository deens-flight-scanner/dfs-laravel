<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

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
     * Geef laptops in de price-range
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
