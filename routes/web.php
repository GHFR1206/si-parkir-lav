<?php

use App\Http\Controllers\AkunController;
use Illuminate\Routing\RouteGroup;
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
    Route::get('/parkir/data/masuk', 'index')->name('parkir.index');
    Route::get('/parkir/data/keluar', 'data_keluar')->name('parkir.data-keluar');
    Route::get('/parkir/{parkir}/detail', 'detail')->name('parkir.detail');
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
Route::controller(ReportController::class)->middleware('auth')->group(function () {
    Route::get('/laporan', 'report')->name('report.getLaporan');
    Route::post('/laporan/postLaporan', 'postReport')->name('report.postLaporan');
    Route::get('/laporan/export', 'exportReport')->name('report.exportLaporan');
    Route::get('/{parkir}/export/invoice', 'exportInvoice')->name('report.exportInvoice');
    Route::get('/{parkir}/export/keluar', 'exportKeluar')->name('report.exportKeluar');
    Route::get('/{parkir}/print', 'print')->name('report.print');
});

// Akun
Route::get('/profile', [AkunController::class, 'profile'])->name('profile')->middleware('auth');
Route::controller(AkunController::class)->middleware(['auth', 'admin'])->group(function () {
    Route::resource('akun', AkunController::class);
});

// Route::get('/forgot/password', [AkunController::class, 'forgotPassword'])->name('forgot-password');
// Route::post('/reset/password', [AkunController::class, 'resetPassword'])->name('reset-password');
// Route::post('/update/{akun}/password', [AkunController::class, 'updatePassword'])->name('update-password');
