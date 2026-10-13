@extends('layouts.app')
@section('title', 'Data Peserta')
@section('content')
<style>
    .btn-utama{
        background-color: rgb(253, 43, 148);
    }
    .btn-utama:hover{
        background-color: #f4a6b8;
    }
    .btn-kedua{
        background-color: #FFE962;
    }
    .btn-kedua:hover{
        background-color:#fff4ac;
    }
    .table-color th {
        background-color: rgb(253, 43, 148);
        color: white;
    }
    .btn-detail{
        background-color:#a8d8ea;
        border-color:##a8d8ea;
        color:black;
    }
    .btn-detail:hover {
        background-color:#7fc5df;
        border-color:#7fc5df;
        color:black;
    }
    .btn-edit{
        background-color:#f8d7a8;
        border-color:#f8d7a8;
        color:black;
    }
    .btn-edit:hover{
        background-color:#efc17d;
        border-color:#efc17d;
        color:black;
    }
    .btn-hapus{
        background-color:#f4a6b8;
        border-color:#f4a6b8;
        color:black;
    }
    .btn-hapus:hover{
        background-color:#e8899f;
        border-color:#e889f;
        color:black;
    }
</style>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Data Peserta</h2>
        <p class="text-muted mb-0">
            Daftar peserta sertifikasi
        </p>
    </div>
    <a href="{{ route('peserta.create') }}" class="btn btn-utama text-white">
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

                <button type="submit" class="btn btn-utama text-white">
                    Cari
                </button>

                @if(request('search'))
                    <a href="{{ route('peserta.index') }}" class="btn btn-kedua ">
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
                <thead class="table-color">
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
                        <td>{{ $peserta->no_peserta }}</td>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->nik }}</td>
                        <td>{{ $peserta->email ?? '-' }}</td>
                        <td>{{ $peserta->no_hp ?? '-' }}</td>
                        <td>{{ $peserta->skemaSertifikasi->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('peserta.show', $peserta->id) }}"class="btn btn-detail btn-sm">Detail</a>
                            <a href="{{ route('peserta.edit', $peserta->id) }}"class="btn btn-edit btn-sm">Edit</a>
                            <form action="{{ route('peserta.destroy', $peserta->id) }}"method="POST"class="d-inline"onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="btn btn-hapus btn-sm">Hapus</button>
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
           class="btn btn-utama text-white">
            + Tambah Peserta
        </a>
    </div>
</div>
@endif
@endsection