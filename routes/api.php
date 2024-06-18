<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'App\Http\Middleware\XAuthorizationMiddleware'])->group(function () {
    Route::resource('teams', TeamController::class);

    Route::resource('players', PlayerController::class);

    Route::resource('games', GameController::class);

    Route::group(['prefix' => 'search'], function () {
        Route::get('/teams', [TeamController::class, 'search']);
        Route::get('/players', [PlayerController::class, 'search']);
        Route::get('/games', [GameController::class, 'search']);
    });
});
