<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create()
    {
        $skemas = SkemaSertifikasi::all();
        return view('pendaftaran.create', compact('skemas'));
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            'no_peserta' => 'required|string|max:50|unique:pesertas,no_peserta',
            'nama' => ['required', 'string', 'max:50', "regex:/^[\pL\s'-]+$/u"],
            'nik' => [
                'required',
                'digits:16',
                'unique:pesertas,nik',
            ],
            'email' => 'nullable|email|max:50',
            'no_hp' => ['nullable', 'regex:/^[0-9]+$/', 'max:20'],
            'alamat' => 'nullable|string',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id',
        ]);

        Peserta::create($validated);

        return redirect()
            ->route('pendaftaran.create')
            ->with('success', 'Pendaftaran sertifikasi berhasil dikirim!');
    }
}
