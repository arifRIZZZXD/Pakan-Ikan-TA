<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\settingsController;
use App\Http\Controllers\Api\SensorDataController;
use App\Http\Controllers\Api\FeedScheduleController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['device-key'])->group(function () {
    //beri data jadwal waktu pakan ke alat
    Route::get('/time-feed', [FeedScheduleController::class, 'timeFeed']);
    Route::get('/settings', [settingsController::class, 'settings']);
    Route::post('/sensor-data', [SensorDataController::class, 'sensors']);

});
