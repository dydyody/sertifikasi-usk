<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #fff5fa; }
        .navbar-utama { background-color: rgb(253, 43, 148); }
        .btn-utama { background-color: rgb(253, 43, 148); color: white; }
        .btn-utama:hover { background-color: #e91e83; color: white; }
        .kartu-statistik { border: none; border-radius: 14px; }
        .angka { color: rgb(253, 43, 148); font-size: 2rem; font-weight: 700; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-utama">
    <div class="container">
        <span class="navbar-brand">Aplikasi Sertifikasi</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container py-5">
    <h2>Dashboard Peserta</h2>
    <p class="text-muted">
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>!
    </p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
        $pendaftarans = $peserta?->pendaftarans ?? collect();
    @endphp

    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <div class="card kartu-statistik shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Sertifikasi Didaftarkan</h6>
                    <div class="angka">{{ $pendaftarans->count() }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card kartu-statistik shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Sertifikasi Selesai</h6>
                    <div class="angka">
                        {{ $pendaftarans->where('status', 'Selesai')->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h5 class="mb-0">Riwayat Pendaftaran Sertifikasi</h5>
                <a href="{{ route('pendaftaran.create') }}" class="btn btn-utama">
                    + Daftar Sertifikasi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Kode Skema</th>
                            <th>Nama Skema</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftarans as $pendaftaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pendaftaran->skemaSertifikasi?->kode ?? '-' }}</td>
                                <td>{{ $pendaftaran->skemaSertifikasi?->nama ?? '-' }}</td>
                                <td>{{ $pendaftaran->created_at?->format('d-m-Y') ?? '-' }}</td>
                                <td>
                                    @if ($pendaftaran->status === 'Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($pendaftaran->status === 'Menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $pendaftaran->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('peserta.sertifikasi.detail', $pendaftaran->id) }}"
                                    class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada riwayat pendaftaran sertifikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
