<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Pendaftaran;
use App\Models\SkemaSertifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function create()
    {
        $skemas = SkemaSertifikasi::all();

        $peserta = null;

        if (Auth::check() && Auth::user()->role === 'peserta') {
            $peserta = Peserta::where(
                'email',
                Auth::user()->email
            )->first();
        }

        return view('pendaftaran.create', compact('skemas', 'peserta'));
    }

    public function store(Request $request)
    {
        // Peserta yang sudah login mendaftar skema tambahan.
        if (Auth::check() && Auth::user()->role === 'peserta') {
            $peserta = Peserta::where(
                'email',
                Auth::user()->email
            )->firstOrFail();

            $validated = $request->validate([
                'skema_sertifikasi_id' => [
                    'required',
                    'exists:skema_sertifikasis,id',
                    Rule::unique('pendaftarans', 'skema_sertifikasi_id')
                        ->where('peserta_id', $peserta->id),
                ],
            ], [
                'skema_sertifikasi_id.unique' =>
                    'Kamu sudah terdaftar pada skema sertifikasi ini.',
            ]);

            Pendaftaran::create([
                'peserta_id' => $peserta->id,
                'skema_sertifikasi_id' => $validated['skema_sertifikasi_id'],
                'status' => 'Terdaftar',
            ]);

            return redirect()->route('peserta.dashboard')
                ->with('success', 'Pendaftaran sertifikasi berhasil.');
        }

        // Pendaftaran peserta baru.
        $validated = $request->validate([
            // 'no_peserta' => 'required|string|max:50|unique:pesertas,no_peserta',
            'nama' => [
                'required', 'string', 'max:50',
                "regex:/^[\pL\s'-]+$/u",
            ],
            'nik' => 'required|digits:16|unique:pesertas,nik',
            'email' => 'required|email|max:50|unique:users,email',
            'no_hp' => ['nullable', 'regex:/^[0-9]+$/', 'max:20'],
            'alamat' => 'nullable|string',
            'skema_sertifikasi_id' =>
                'required|exists:skema_sertifikasis,id',
        ], [
            'nama.regex' =>
            'Nama hanya boleh berisi huruf, spasi, tanda petik satu, dan tanda hubung.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah digunakan untuk akun lain.',
        ]);


        DB::transaction(function () use ($validated) {
            $pesertaTerakhir = Peserta::orderBy('id', 'desc')->first();
            $nomorBerikutnya = $pesertaTerakhir
                ? ((int) substr($pesertaTerakhir->no_peserta, 1)) + 1
                : 1;
            $noPeserta = 'P' . str_pad($nomorBerikutnya, 3, '0', STR_PAD_LEFT);
            $peserta = Peserta::create([
                'no_peserta' => $noPeserta,
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'skema_sertifikasi_id' => $validated['skema_sertifikasi_id'],
            ]);

            $user = User::create([
                'name' => $peserta->nama,
                'email' => $peserta->email,
                'password' => Hash::make($peserta->nik),
                'role' => 'peserta',
            ]);
            Auth::login($user);
            session()->regenerate();

            Pendaftaran::firstOrCreate(
                [
                    'peserta_id' => $peserta->id,
                    'skema_sertifikasi_id' => $validated['skema_sertifikasi_id'],
                ],
                [
                    'status' => 'Terdaftar',
                ]
            );

            session(['peserta_dashboard_id' => $peserta->id]);
        });


        return redirect()->route('pendaftaran.success');
    }


    public function success()
    {
        $id = session('peserta_dashboard_id');

        if (!$id) {
            return redirect()->route('pendaftaran.create')
                ->with('error', 'Silakan lakukan pendaftaran terlebih dahulu.');
        }

        $peserta = Peserta::findOrFail($id);

        $pendaftaran = Pendaftaran::with('skemaSertifikasi')
            ->where('peserta_id', $peserta->id)
            ->latest('id')
            ->first();

        $skema = $pendaftaran?->skemaSertifikasi;

        return view('pendaftaran.success', compact(
            'peserta',
            'skema',
            'pendaftaran'
        ));
    }



    public function dashboard()
    {
        $id = session('peserta_dashboard_id');

        if (!$id) {
            return redirect()->route('pendaftaran.create')
                ->with('error', 'Silakan lakukan pendaftaran terlebih dahulu.');
        }

        $peserta = Peserta::findOrFail($id);

        $pendaftaran = Pendaftaran::with('skemaSertifikasi')
            ->where('peserta_id', $peserta->id)
            ->latest('id')
            ->first();

        $skema = $pendaftaran?->skemaSertifikasi;

        return view('pendaftaran.dashboard', compact(
            'peserta',
            'pendaftaran',
            'skema'
        ));
    }

}
