<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingDataController;
use App\Http\Controllers\SettingToolsController;
use App\Http\Controllers\NotificationsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginProses', [LoginController::class, 'auth'])->name('loginProses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function(){
// });
Route::resource('dashboard', DashboardController::class);

// Route::get('setting',[SettingToolsController::class , 'index'])->name('setting');
// // Route::resource('setting',[SettingToolsController::class])->only('index', 'update');
// Route::get('setting',[SettingToolsController::class , 'update']);

Route::get('settings', [SettingDataController::class, 'index'])->name('settings.index');
Route::get('settings/{id}/edit', [SettingDataController::class, 'edit'])->name('settings.editSettings');
Route::put('settings/{id}', [SettingDataController::class, 'update'])->name('settings.update');

Route::get('report',[ReportsController::class, 'index'])->name('report');
Route::get('notification',[NotificationsController::class, 'index'])->name('notification');
