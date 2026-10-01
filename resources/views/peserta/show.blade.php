@extends('layouts.app')
@section('title','Detail Peserta')
@section('content')
<div class="d-fiex justify-content-between align-items-center mb-4">
    <div>
        <h2>Detail Peserta</h2>
        <p class="text-muted mb-0">Informasi Lengkap peserta sertifikasi</p>
    </div>
    <a href="{{route('peserta.index')}}" class="btn btn-secondary">
        Kembali
    </a>
</div>
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <strong>Data Peserta</strong>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">No.Peserta</div>
            <div class="col-md-8">{{$peserta->no_peserta}}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Nama</div>
            <div class="col-md-8">{{$peserta->nama}}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">NIK</div>
            <div class="col-md-8">{{$peserta->nik}}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Email</div>
            <div class="col-md-8">{{$peserta->email ?? '-' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">No.Hp</div>
            <div class="col-md-8">{{$peserta->no_hp ?? '-' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Alamat</div>
            <div class="col-md-8">{{$peserta->alamat ?? '-' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Skema Sertifikasi</div>
            <div class="col-md-8">
                @if($peserta->skemaSertifikasi)
                {{$peserta->skemaSertifikasi->kode}} -
                {{$peserta->skemaSertifikasi->kode}}
                @else
                -
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">Dibuat</div>
            <div class="col-md-8">{{ $peserta->created_at->format('d-m-Y H:i') }}</div>
        </div>
        <div class="row">
            <div class="col-md-4 fw-bold">Terakhir Diperbarui</div>
            <div class="col-md-8">
                {{ $peserta->updated_at->format('d-m-Y H:i') }}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('peserta.edit', $peserta->id) }}"
           class="btn btn-warning">
            Edit Peserta
        </a>
        <a href="{{ route('peserta.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>
@endsection