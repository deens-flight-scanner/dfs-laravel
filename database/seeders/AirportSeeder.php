<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;
use File;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Airport::truncate();
  
        $json = File::get("database/data/airports.json");
        $airports = json_decode($json);
  
        foreach ($airports as $key => $value) {
            Airport::create([
                "code" => $value->code,
                "lat" => $value->lat,
                "lon" => $value->lon,
                "name" => $value->name,
                "city" => $value->city,
                "state" => $value->state,
                "country" => $value->country,
                "woeid" => $value->woeid,
                "tz" => $value->tz,
                "phone" => $value->phone,
                "type" => $value->type,
                "email" => $value->email,
                "url" => $value->url,
                "runway_length" => $value->runway_length,
                "elev" => $value->elev,
                "icao" => $value->icao,
                "direct_flights" => $value->direct_flights,
                "carriers" => $value->carriers
            ]);
        }
    }
}
