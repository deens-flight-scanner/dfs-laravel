<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SoapController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// routes
Route::get('/favorites/search/{user_id}', [FavoriteController::class, 'showByUserID'])->middleware(['auth:sanctum']);

Route::post('/favorites/', [FavoriteController::class, 'store'])->middleware(['auth:sanctum']);

Route::delete('/favorites/expired', [FavoriteController::class, 'destroyExpired'])->middleware(['auth:sanctum']);

Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->middleware(['auth:sanctum']);


Route::get('/time/zone/{airport_code}', [SoapController::class, 'timeZone']);

Route::get('/time/difference/{departure_code}/{arrival_code}', [SoapController::class, 'timeDifference']);


Route::get('/airports/search/{name}', [AirportController::class, 'searchAirports']);

Route::get('/flights/search/{airport}/{budget}/{depart}/{return}/{exactDates}', [AirportController::class, 'searchFlights']);