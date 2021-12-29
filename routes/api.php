<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FavoriteController;

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

// Favorite object CRUD
// Route::resource('favorites', FavoriteController::class);
Route::post('/favorites', [FavoriteController::class, 'store']);
Route::get('/favorites/search/{user_id}', [FavoriteController::class, 'showByUserID']);
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/airports/search/{name}', [AirportController::class, 'searchAirports']);

Route::get('/flights/search/{airport}/{budget}/{depart}/{return}/{exactDates}', [AirportController::class, 'searchFlights']);
