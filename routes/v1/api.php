<?php

use App\Http\Controllers\v1\Auth\AuthController;
use App\Http\Controllers\v1\Location\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
});

Route::prefix('location')->controller(LocationController::class)->group(function () {
    Route::get('cities', 'cities');
    Route::get('districts', 'districts');
});
