<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'code',
        'lat',
        'lon',
        'name',
        'city',
        'state',
        'country',
        'woeid',
        'tz',
        'phone',
        'type',
        'email',
        'url',
        'runway_length',
        'elev',
        'icao',
        'direct_flights',
        'carriers'
    ];
}
