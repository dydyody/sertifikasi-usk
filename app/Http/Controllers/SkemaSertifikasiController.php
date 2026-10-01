<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkemaSertifikasi;
use Illuminate\Support\Facades\DB;
USE Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SkemaSertifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $skemas = SkemaSertifikasi::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
            });
        })->latest()->get();

        return view('skema.index', compact('skemas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'=> [
                'required',
                'string',
                'max:50',
                'unique:skema_sertifikasis,kode',
            ],
            'nama'=>[
                'required',
                'string',
                'max:255',
            ],
            'deskripsi'=>[
                'nullable',
                'string',
            ],
        ], [
            'kode.required'=>'Kode wajib diisi.',
            'kode.unique'=>'Kode sudah digunakan.',
            'nama.required'=>'Nama wajib diisi.',
        ]);

        try{
            DB::transaction(function()use($validated){
                SkemaSertifikasi::create($validated);
            });
            return redirect()->route('skema.index')->with('success','Skema sertifikasi berhasil ditambahkan');
        } catch (\Throwable $e){
            Log::error('Gagal menambahkan skema sertifikasi',[
                'error'=>$e->getMessage(),
            ]);
            return back()->withInput()->with('error','Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit(SkemaSertifikasi $skema)
    {
        return view('skema.edit', compact('skema'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(Request $request, SkemaSertifikasi $skema)
    {
        $validated = $request->validate([
            'kode'=> [
                'required',
                'string',
                'max:50',
                Rule::unique('skema_sertifikasis','kode')->ignore($skema->id),
            ],
            'nama'=>[
                'required',
                'string',
                'max:255',
            ],
            'deskripsi'=>[
                'nullable',
                'string',
            ],
        ], [
            'kode.required'=>'Kode wajib diisi.',
            'kode.unique'=>'Kode sudah digunakan',
            'nama.required'=>'Nama wajib diisi',
        ]);

        try{
            DB::transaction(function()use($skema,$validated){
                $skema->update($validated);
            });
            return redirect()->route('skema.index')->with('success','Skema sertifikasi berhasil diperbarui');
        } catch (\Throwable $e){
            Log::error('Gagal memperbarui skema sertifikasi.',[
                'id'=>$skema->id,
                'error'=>$e->getMessage(),
            ]);
            return back()->withInput()->with('error','Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skema = SkemaSertifikasi::findOrFail($id);
        try {
            $skema->delete();
            return redirect()->route('skema.index')->with('success','Skema sertifikasi berhasil dihapus');
        } catch (\Throwable $e){
            Log::warning('Skema gagal dihapus.',[
                'id'=>$skema->id,
                'error'=>$e->getMessage(),
            ]);
            return redirect()->route('skema-index')->with('error','Skema tidak dihapus karena masih digunakan oleh peserta.');
        }
    }
}
