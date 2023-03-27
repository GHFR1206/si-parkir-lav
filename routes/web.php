<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ParkingUserController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Admin
Route::controller(ParkingController::class)->middleware('auth')->group(function () {
    Route::resource('parkir', ParkingController::class);
    Route::post('/masuk/parkir', 'store')->name('parkir.store');
    Route::get('/masuk/parkir', 'create')->name('parkir.create');
    Route::get('/keluar/parkir', 'parkirKeluar')->name('parkir.getKeluar');
    Route::post('/keluar/parkir', 'parkirKeluar')->name('parkir.postKeluar');
    Route::put('/parkir/{parkir}/keluar', 'keluar')->name('parkir.update.keluar');
});

// User
Route::resource('user', ParkingUserController::class);
Route::get('/', [ParkingUserController::class, 'index'])->name('home');
Route::get('/user/{user}/keluar', [ParkingUserController::class, 'edit'])->name('user.keluar');

// Report Controlller
Route::get('/parkir/{parkir}/export', [ReportController::class, 'exportPDF'])->name('exportPDF');
Route::get('/parkir/{parkir}/print', [ReportController::class, 'print'])->name('print');
