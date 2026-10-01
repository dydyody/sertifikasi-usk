@extends('layouts.app')
@section('title','Skema Sertifikasi')
@section('page-title','Skema Sertifikasi')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Skema Sertifikasi</h3>
        <p class="text-muted mb-0">Kelola data skema sertifikasi</p>
    </div>
    <a href="{{route('skema.create')}}" class="btn btn-primary">+ Tambah Skema</a>
</div>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('skema.index') }}" method="GET">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari kode atau nama skema..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn btn-primary">
                    Cari
                </button>

                @if(request('search'))
                    <a href="{{ route('skema.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@if ($skemas->count()>0)
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Kode</th>
                        <th>Nama Skema</th>
                        <th>Deskripsi</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skemas as $skema)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            <span clas="badge bg-primary">
                                {{$skema->kode}}
                            </span>
                        </td>
                        <td>
                            <strong>
                                {{$skema->nama}}
                            </strong>
                        </td>
                        <td>
                            {{$skema->deskripsi ?:'-'}}
                        </td>
                        <td>
                            <a href="{{route('skema.edit',$skema)}}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form 
                        action="{{route('skema.destroy',$skema)}}" method="POST" class="d-inline" onsubmit="return confirm('Yakin Ingin menghapus skema?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
        <h5>Belum ada data skema</h5>
        <p class="text-muted">Silahkan tambah skema sertifikasi terlebih dahulu</p>
        <a href="{{route('skema.create')}}" class="btn btn-primary">+ Tambah Skema</a>
    </div>
</div>
@endif
@endsection
