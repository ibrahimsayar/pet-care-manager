<?php

use App\Http\Controllers\Admin\v1\Auth\AuthController;
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
    Route::post('login', 'authentication');

    Route::middleware('admin_authentication')->group(function() {
        Route::get('refresh', 'refresh');
        Route::delete('logout', 'logout');
    });
});
