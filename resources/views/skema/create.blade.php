@extends('layouts.app')
@section('title', 'Tambah Skema')
@section('page-title', 'Tambah Skema Sertifikasi')
@section('content')
<div class="mb-4">
    <h3 class="fw-bold">
        Tambah Skema Sertifikasi
    </h3>
    <p class="text-muted">
        Masukkan informasi skema sertifikasi.
    </p>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('skema.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kode" class="form-label">Kode Skema</label>
                <input type="text" name="kode" id="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode') }}" placeholder="Contoh: SKM-001" required>
                @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">
                    Nama Skema
                </label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}"
                    placeholder="Nama skema sertifikasi"
                    required
                >
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">
                    Deskripsi
                </label>
                <textarea
                    name="deskripsi"
                    id="deskripsi"
                    rows="4"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    placeholder="Deskripsi skema sertifikasi"
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <a
                    href="{{ route('skema.index') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection