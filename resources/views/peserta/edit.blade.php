@extends('layouts.app')

@section('title', 'Edit Peserta')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Peserta</h2>
        <p class="text-muted mb-0">
            Perbarui data peserta sertifikasi
        </p>
    </div>

    <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Terdapat kesalahan:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="no_peserta" class="form-label">
                    No. Peserta
                </label>

                <input
                    type="text"
                    name="no_peserta"
                    id="no_peserta"
                    class="form-control @error('no_peserta') is-invalid @enderror"
                    value="{{ old('no_peserta', $peserta->no_peserta) }}"
                    required
                >

                @error('no_peserta')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">
                    Nama Peserta
                </label>

                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $peserta->nama) }}"
                    required
                >

                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>

                <input
                    type="text"
                    name="nik"
                    id="nik"
                    class="form-control @error('nik') is-invalid @enderror"
                    value="{{ old('nik', $peserta->nik) }}"
                    required
                >

                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $peserta->email) }}"
                >

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>

                <input
                    type="text"
                    name="no_hp"
                    id="no_hp"
                    class="form-control @error('no_hp') is-invalid @enderror"
                    value="{{ old('no_hp', $peserta->no_hp) }}"
                >

                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>

                <textarea
                    name="alamat"
                    id="alamat"
                    class="form-control @error('alamat') is-invalid @enderror"
                    rows="3"
                >{{ old('alamat', $peserta->alamat) }}</textarea>

                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="skema_sertifikasi_id" class="form-label">
                    Skema Sertifikasi
                </label>

                <select
                    name="skema_sertifikasi_id"
                    id="skema_sertifikasi_id"
                    class="form-select @error('skema_sertifikasi_id') is-invalid @enderror"
                    required
                >
                    <option value="">-- Pilih Skema Sertifikasi --</option>

                    @foreach($skemas as $skema)
                        <option
                            value="{{ $skema->id }}"
                            {{ old('skema_sertifikasi_id', $peserta->skema_sertifikasi_id) == $skema->id ? 'selected' : '' }}
                        >
                            {{ $skema->kode }} - {{ $skema->nama }}
                        </option>
                    @endforeach
                </select>

                @error('skema_sertifikasi_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('peserta.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection