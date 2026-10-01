<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkemaSertifikasiController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::resource('skema',SkemaSertifikasiController::class)
    ->except(['show']);

    Route::resource('peserta',PesertaController::class);
});
