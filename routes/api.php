<?php

use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum', 'App\Http\Middleware\XAuthorizationMiddleware'])->group(function () {
    Route::resource('teams', \App\Http\Controllers\TeamController::class);

    Route::resource('players', \App\Http\Controllers\PlayerController::class);

    Route::resource('games', \App\Http\Controllers\GameController::class);

    Route::group(['prefix' => 'search'], function () {
        Route::get('/teams', [\App\Http\Controllers\TeamController::class, 'search']);
        Route::get('/players', [\App\Http\Controllers\PlayerController::class, 'search']);
        Route::get('/games', [\App\Http\Controllers\GameController::class, 'search']);
    });
});
