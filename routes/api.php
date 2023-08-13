<?php

use App\Http\Controllers\AuthenticationController;
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

Route::middleware('api')
    ->prefix('v1')
    ->group(function () {
        /*
         * Authentication Route
         */
        Route::prefix('auth')
            ->group(function () {
                Route::post('login', [AuthenticationController::class, 'login']);
                Route::post('logout', [AuthenticationController::class, 'logout'])
                    ->middleware('auth:api');
                Route::post('refresh', [AuthenticationController::class, 'refresh'])
                    ->middleware('auth:api');
            });

    });
