<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
use App\Http\Controllers\HomeController;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari-jadwal', [HomeController::class, 'cariJadwal'])->name('cari.jadwal');

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    // ...existing routes...
    
    Route::get('/reservasi', [AdminReservasiController::class, 'index'])->name('admin.reservasi.index');
    Route::get('/reservasi/{reservasi}', [AdminReservasiController::class, 'show'])->name('admin.reservasi.show');
    Route::patch('/reservasi/{reservasi}/status', [AdminReservasiController::class, 'updateStatus'])->name('admin.reservasi.status.update');
});
// Pasien Routes
Route::group(['middleware' => 'auth:pasien'], function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('dashboard');
    
    Route::resource('reservasi', ReservasiController::class);
});
// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::resource('dokter', DokterController::class, ['as' => 'admin']);
});
// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
