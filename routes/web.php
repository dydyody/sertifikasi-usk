
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkemaSertifikasiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;
use App\Models\Peserta;
use Illuminate\Http\Request;
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

// HALAMAN PENDAFTARAN SERTIFIKASI
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])
    ->name('pendaftaran.create');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
    ->name('pendaftaran.store');

Route::get('/pendaftaran/berhasil', [PendaftaranController::class, 'success'])
    ->name('pendaftaran.success');

Route::get('/pendaftaran/dashboard', [PendaftaranController::class, 'dashboard'])
    ->name('pendaftaran.dashboard');

// HALAMAN YANG PERLU LOGIN

Route::middleware('auth')->group(function () {
    // DASHBOARD ADMIN
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/peserta/dashboard', function (Request $request) {
        abort_unless($request->user()->role === 'peserta', 403);

        $peserta = Peserta::with('pendaftarans.skemaSertifikasi')
            ->where('email', $request->user()->email)
            ->firstOrFail();

        return view('peserta.dashboard', compact('peserta'));
    })->name('peserta.dashboard');

    // DASHBOARD PESERTA
    Route::get('/peserta/sertifikasi/{pendaftaran}', function (
        \App\Models\Pendaftaran $pendaftaran
        ) {
            $user = request()->user();

            abort_unless($user->role === 'peserta', 403);

            $peserta = \App\Models\Peserta::where('email', $user->email)
                ->firstOrFail();

            abort_unless($pendaftaran->peserta_id === $peserta->id, 403);

            $pendaftaran->load('skemaSertifikasi');
            $skema = $pendaftaran->skemaSertifikasi;

            return view('pendaftaran.dashboard', compact(
                'peserta',
                'pendaftaran',
                'skema'
            ));
        })->name('peserta.sertifikasi.detail');

    //   CRUD DATA SKEMA SERTIFIKASI
    Route::resource('skema', SkemaSertifikasiController::class)
        ->except(['show'])
        ->middleware('can:akses-admin');

    // CRUD DATA PESERTA
    Route::resource('peserta', PesertaController::class)
        ->middleware('can:akses-admin');
});
