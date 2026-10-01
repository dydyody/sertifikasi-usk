@extends('layouts.app')
@section('title', 'Data Peserta')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Data Peserta</h2>
        <p class="text-muted mb-0">
            Daftar peserta sertifikasi
        </p>
    </div>
    <a href="{{ route('peserta.create') }}" class="btn btn-primary">
        + Tambah Peserta
    </a>
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('peserta.index') }}" method="GET">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama, NIK, atau nomor peserta..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn btn-primary">
                    Cari
                </button>

                @if(request('search'))
                    <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@if($pesertas->count() > 0)
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th width="60">No</th>
                        <th>No. Peserta</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Skema Sertifikasi</th>
                        <th width="190">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesertas as $peserta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $peserta->no_peserta }}
                        </td>
                        <td>
                            {{ $peserta->nama }}
                        </td>
                        <td>
                            {{ $peserta->nik }}
                        </td>
                        <td>
                            {{ $peserta->email ?? '-' }}
                        </td>
                        <td>
                            {{ $peserta->no_hp ?? '-' }}
                        </td>
                        <td>
                            {{ $peserta->skemaSertifikasi->nama ?? '-' }}
                        </td>
                        <td>
                            <a href="{{ route('peserta.show', $peserta->id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>
                            <a href="{{ route('peserta.edit', $peserta->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <form action="{{ route('peserta.destroy', $peserta->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="card shadow-sm">
    <div class="card-body text-center py-5">
        <h5>Belum ada data peserta</h5>
        <p class="text-muted">
            Silahkan tambah peserta terlebih dahulu.
        </p>
        <a href="{{ route('peserta.create') }}"
           class="btn btn-primary">
            + Tambah Peserta
        </a>
    </div>
</div>
@endif
@endsection