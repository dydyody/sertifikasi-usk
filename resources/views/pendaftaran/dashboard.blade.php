<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - Sertifikasi USK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #fff5fa;
        }
        .navbar-utama {
            background-color: rgb(253, 43, 148);
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
        .btn-kedua{
        background-color: #FFE962;
        }
        .btn-kedua:hover{
            background-color:#fff4ac;
        }
        .card {
            border: none;
            border-radius: 14px;
        }
        .label-data {
            color: #777;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .nilai-data {
            font-weight: 600;
            overflow-wrap: anywhere;
        }
        @media print {
            .navbar-utama,
            .tombol-aksi {
                display: none !important;
            }
            body {
                background: white;
            }
            .card {
                box-shadow: none !important;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark navbar-utama">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand fw-bold">
            Aplikasi Sertifikasi
        </a>

        <a href="{{ route('home') }}" class="btn btn-kedua btn-sm">
            Beranda
        </a>
    </div>
</nav>

<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold">Dashboard Peserta</h2>
        <p class="text-muted mb-0">
            Selamat datang, <strong>{{ $peserta->nama }}</strong>!
        </p>
        <p class="text-muted">
            Berikut informasi pendaftaran sertifikasi kamu.
        </p>
    </div>

    {{-- Ringkasan --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="label-data">Nomor Peserta</div>
                    <h4 class="nilai-data mb-0">
                        {{ $peserta->no_peserta }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="label-data">Status Pendaftaran</div>
                    <h5 class="mb-0">
                        <span class="badge bg-success">Terdaftar</span>
                    </h5>
                </div>
            </div>
        </div>

    </div>

    {{-- Detail peserta --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">Informasi Data Peserta</h5>

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="label-data">Nama Lengkap</div>
                    <div class="nilai-data">{{ $peserta->nama }}</div>
                </div>

                <div class="col-md-6">
                    <div class="label-data">NIK</div>
                    <div class="nilai-data">{{ $peserta->nik }}</div>
                </div>

                <div class="col-md-6">
                    <div class="label-data">Email</div>
                    <div class="nilai-data">{{ $peserta->email ?: '-' }}</div>
                </div>

                <div class="col-md-6">
                    <div class="label-data">Nomor HP</div>
                    <div class="nilai-data">{{ $peserta->no_hp ?: '-' }}</div>
                </div>

                <div class="col-12">
                    <div class="label-data">Alamat</div>
                    <div class="nilai-data">{{ $peserta->alamat ?: '-' }}</div>
                </div>

            </div>

        </div>
    </div>

    {{-- Detail skema --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">Informasi Skema Sertifikasi</h5>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="label-data">Kode Skema</div>
                    <div class="nilai-data">
                        {{ $skema->kode ?? '-' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="label-data">Nama Skema</div>
                    <div class="nilai-data">
                        {{ $skema->nama ?? '-' }}
                    </div>
                </div>

                <div class="col-12">
                    <div class="label-data">Status</div>
                    <span class="badge bg-success">Pendaftaran Berhasil</span>
                </div>

            </div>

        </div>
    </div>


    {{-- Tombol aksi --}}

    <div class="d-flex flex-wrap gap-2 tombol-aksi">
        <a href="{{ route('peserta.dashboard') }}"
        class="btn btn-detail">
            &larr; Kembali ke Dashboard Peserta
        </a>

        <button onclick="window.print()" class="btn btn-edit">
            Cetak Bukti Pendaftaran
        </button>

        <a href="{{ route('pendaftaran.create') }}"
        class="btn btn-hapus">
            Daftar Peserta Lain
        </a>
    </div>

</div>
</body>
</html>

