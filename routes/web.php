<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkemaSertifikasiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// HALAMAN PUBLIK
Route::view('/', 'home')->name('home');

// LOGIN DAN LOGOUT
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// PENDAFTARAN SERTIFIKASI PUBLIK
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])
    ->name('pendaftaran.create');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
    ->name('pendaftaran.store');

// HALAMAN YANG MEMERLUKAN LOGIN
Route::middleware('auth')->group(function () {

    // DASHBOARD ADMIN
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD SKEMA SERTIFIKASI
    Route::resource('skema', SkemaSertifikasiController::class)
        ->except(['show']);

    // CRUD DATA PESERTA (ADMIN)
    Route::resource('peserta', PesertaController::class);

    // DASHBOARD PESERTA
    Route::get('/peserta/dashboard', function () {
        return view('peserta.dashboard');
    })->name('peserta.dashboard');
});
