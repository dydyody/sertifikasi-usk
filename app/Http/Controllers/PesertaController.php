<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Support\Facades\Log;

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
        $validated = $request->validate([
            'no_peserta' => 'required|string|max:50|unique:pesertas,no_peserta',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:pesertas,nik',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id',
        ]);
        Peserta::create($validated);
        return redirect()->route('peserta.index')->with('success','Peserta berhasil ditambahkan.');
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
