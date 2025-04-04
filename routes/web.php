<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\HomeController;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari-jadwal', [HomeController::class, 'cariJadwal'])->name('cari.jadwal');

// Auth Routes untuk Pasien
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Auth Routes untuk Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Pasien Routes
Route::middleware('auth:pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('dashboard');
    
    Route::resource('reservasi', ReservasiController::class);
});

// Admin Routes
Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('dokter', DokterController::class);
    
    Route::get('reservasi', [AdminReservasiController::class, 'index'])->name('reservasi.index');
    Route::get('reservasi/{reservasi}', [AdminReservasiController::class, 'show'])->name('reservasi.show');
    Route::patch('reservasi/{reservasi}/status', [AdminReservasiController::class, 'updateStatus'])->name('reservasi.status.update');
    
    // Admin Trash Routes
    Route::prefix('trash')->name('trash.')->group(function () {
        // Dokter Trash
        Route::get('dokter', [TrashController::class, 'indexDokter'])->name('dokter');
        Route::patch('dokter/{id}/restore', [TrashController::class, 'restoreDokter'])->name('dokter.restore');
        Route::delete('dokter/{id}/force-delete', [TrashController::class, 'forceDeleteDokter'])->name('dokter.force-delete');
        
        // Reservasi Trash
        Route::get('reservasi', [TrashController::class, 'indexReservasi'])->name('reservasi');
        Route::patch('reservasi/{id}/restore', [TrashController::class, 'restoreReservasi'])->name('reservasi.restore');
        Route::delete('reservasi/{id}/force-delete', [TrashController::class, 'forceDeleteReservasi'])->name('reservasi.force-delete');
    });
});