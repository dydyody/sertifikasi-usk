@extends('layouts.app')
@section('title', 'Edit Skema')
@section('page-title', 'Edit Skema Sertifikasi')
@section('content')
<div class="mb-4">
    <h3 class="fw-bold">
        Edit Skema Sertifikasi
    </h3>
    <p class="text-muted">
        Perbarui informasi skema sertifikasi.
    </p>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <form
            action="{{ route('skema.update', $skema) }}"
            method="POST"
        >
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kode" class="form-label">
                    Kode Skema
                </label>
                <input
                    type="text"
                    name="kode"
                    id="kode"
                    class="form-control @error('kode') is-invalid @enderror"
                    value="{{ old('kode', $skema->kode) }}"
                    required
                >
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
                    value="{{ old('nama', $skema->nama) }}"
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
                >{{ old('deskripsi', $skema->deskripsi) }}</textarea>
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
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection