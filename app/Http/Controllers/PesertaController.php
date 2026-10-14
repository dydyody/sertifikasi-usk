<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\DB;
USE Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $pesertas = Peserta::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('no_peserta', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%");
            });
        })->get();

        return view('peserta.index', compact('pesertas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skemas=SkemaSertifikasi::orderBy('nama')->get();
        return view('peserta.create',compact('skemas'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $messages = [
            'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, tanda petik satu, dan tanda hubung.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'email.unique' => 'Email sudah digunakan.',
        ];

        $validated = $request->validate([
            'no_peserta' => 'required|string|max:50|unique:pesertas,no_peserta',
            'nama' => ['required', 'string', 'max:50', "regex:/^[\pL\s'-]+$/u"],
            'nik' => 'required|digits:16|unique:pesertas,nik',
            'email' => 'required|email|max:50|unique:pesertas,email|unique:users,email',
            'no_hp' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'alamat' => 'nullable|string',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id',
        ], $messages);

        DB::transaction(function () use ($validated) {
            // Simpan data peserta
            $peserta = Peserta::create([
                'no_peserta' => $validated['no_peserta'],
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'skema_sertifikasi_id' => $validated['skema_sertifikasi_id'],
            ]);

            // Buat akun login peserta dengan password awal berupa NIK
            User::create([
                'name' => $peserta->nama,
                'email' => $peserta->email,
                'password' => Hash::make($peserta->nik),
                'role' => 'peserta',
            ]);
            Pendaftaran::create([
                'peserta_id' => $peserta->id,
                'skema_sertifikasi_id' => $validated['skema_sertifikasi_id'],
                'status' => 'Terdaftar',
            ]);
        });

            return redirect()
                ->route('peserta.index')
                ->with('success', 'Data peserta dan akun login berhasil dibuat.');
        }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peserta=Peserta::with('skemaSertifikasi')->findOrFail($id);
        return view('peserta.show',compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peserta=Peserta::findOrFail($id);
        $skemas=SkemaSertifikasi::orderBy('nama')->get();
        return view('peserta.edit',compact('peserta','skemas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peserta=Peserta::findOrFail($id);
        $validated=$request->validate([
            'no_peserta'=>'required|string|max:50|unique:pesertas,no_peserta,'.$peserta->id,
            'nama'=>'required|string|max:255',
            'nik'=>'required|string|max:20|unique:pesertas,nik,'.$peserta->id,
            'email'=>'nullable|email|max:255',
            'no_hp'=>'nullable|string|max:20',
            'alamat'=>'nullable|string',
            'skema_sertifikasi_id'=>'required|exists:skema_sertifikasis,id',
        ]);
        $peserta->update($validated);
        return redirect()->route('peserta.index')->with('success','Data peserta berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peserta=Peserta::findOrFail($id);
        try{
            $peserta->delete();
            return redirect()->route('peserta.index')->with('success','Data Peserta berhasil dihapus.');
        }catch(\Throwable $e){
            Log::warning('Data Peserta gagal dihapus.',[
                'id'=>$peserta->id,
                'error'=>$e->getMessage(),
            ]);
            return redirect()->route('peserta.index')->with('error','Data Peserta tidak dapat dihapus.');
        }
    }
}
