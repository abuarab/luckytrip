<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirportController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('airports/{airportId}', [AirportController::class, 'show']);
Route::post('airports', [AirportController::class, 'store']);
Route::put('airports/{airportId}', [AirportController::class, 'update']);
Route::delete('airports/{airportId}', [AirportController::class, 'delete']);
Route::get('airports', [AirportController::class, 'get']);
