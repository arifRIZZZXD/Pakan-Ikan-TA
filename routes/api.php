<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\SensorsDataController;
use App\Http\Controllers\Api\FeedsScheduleController;

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
    Route::get('/time-feed', [FeedsScheduleController::class, 'timeFeed']);
    Route::get('/settings', [SettingsController::class, 'settings']);
    Route::post('/sensor-data', [SensorsDataController::class, 'sensors']);

});
