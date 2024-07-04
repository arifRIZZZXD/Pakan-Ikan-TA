<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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

Route::resource('/dashboard', DashboardController::class);

Route::get('/settings', function () {
    return view('admin.settings.index');
});

Route::get('/laporan', function () {
    return view('admin.reports.index');
});

Route::get('/notification', function () {
    return view('admin.notification.index');
});