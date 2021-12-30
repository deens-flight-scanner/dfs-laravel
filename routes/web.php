<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Google login
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// GitHub login
Route::get('auth/github', [LoginController::class, 'redirectToGitHub'])->name('auth.github');
Route::get('auth/github/callback', [LoginController::class, 'handleGitHubCallback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('home', [AirportController::class, 'home']);

Route::get('favorite', [FavoriteController::class, 'home'])->middleware(['auth'])->name('favorite');

Route::get('/', function () {
    return view('home');
});