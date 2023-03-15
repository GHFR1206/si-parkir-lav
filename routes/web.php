<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ParkirUserController;
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

// Admin
Route::controller(ParkirController::class)->group(function () {
    Route::resource('parkir', ParkirController::class)->middleware('auth');
    Route::get('/{user}/keluar', 'update')->name('parkir.exit.user')->middleware('auth');
    Route::get('/selesai', 'data_selesai')->name('parkir.data.selesai')->middleware('auth');
});

// User
Route::resource('user', ParkirUserController::class);

Route::get('/', [ParkirUserController::class, 'index'])->name('home');
Route::get('/user/{user}/keluar', [ParkirUserController::class, 'edit'])->name('user.keluar');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware(['admin', 'auth']);
