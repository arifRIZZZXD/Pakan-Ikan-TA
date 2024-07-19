<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FeedSchedulesController;
use App\Http\Controllers\SettingDataController;
use App\Http\Controllers\SettingToolsController;
use App\Http\Controllers\NotificationsController;
use App\Models\Device;
use App\Models\FeedSchedules;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Login and Logout routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginProses', [LoginController::class, 'auth'])->name('loginProses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Jika Sudah Login
Route::middleware(['auth'])->group(function () {

    // Dashboard routes
    Route::resource('dashboard', DashboardController::class);
    Route::get('/get-latest-sensor-data', [DashboardController::class, 'getLatestSensorData']);

    // Settings routes
    Route::get('settings', [SettingDataController::class, 'index'])->name('settings.index');
    Route::get('settings/{id}/edit', [SettingDataController::class, 'edit'])->name('settings.editSettings');
    Route::put('settings/{id}', [SettingDataController::class, 'update'])->name('settings.update');

    // Feed Schedule routes
    Route::get('feedSchedules', [FeedSchedulesController::class, 'index'])->name('feedSchedules.index');
    Route::get('feedSchedules/{id}/edit', [FeedSchedulesController::class, 'edit'])->name('feedSchedules.edit');
    Route::put('feedSchedules/{id}', [FeedSchedulesController::class, 'update'])->name('feedSchedules.update');

    // Device routes
    Route::get('devices', [DeviceController::class, 'index'])->name('device.index');

    // Report routes
    Route::get('report',[ReportsController::class, 'index'])->name('report.index');

    // Notifications routes
    Route::get('notification',[NotificationsController::class, 'index'])->name('notification.index');
    Route::get('notification/data',[NotificationsController::class, 'getData'])->name('notification.data');
    Route::delete('notification/{id}', [NotificationsController::class, 'destroy'])->name('notification.destroy');

});

Route::fallback(function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});
