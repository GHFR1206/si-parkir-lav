<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware(['admin', 'auth']);

// Admin
Route::controller(ParkingController::class)->middleware('auth')->group(function () {
    Route::resource('parkir', ParkingController::class);
    Route::get('/{parkir}/keluar', 'parkirKeluar')->name('parkir.update.keluar');
    Route::get('/selesai', 'data_selesai')->name('parkir.data.selesai');
    Route::get('/parkir/keluar', 'showParkirKeluar')->name('parkir.keluar');
});

// User
Route::resource('user', ParkingUserController::class);
Route::get('/', [ParkingUserController::class, 'index'])->name('home');
Route::get('/user/{user}/keluar', [ParkingUserController::class, 'edit'])->name('user.keluar');

