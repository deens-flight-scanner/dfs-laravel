<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'departure_airport',
        'departure_city',
        'departure_date',
        'arrival_airport',
        'arrival_city',
        'return_date',
        'price',
        'airline',
        'airline_code',
    ];
}
