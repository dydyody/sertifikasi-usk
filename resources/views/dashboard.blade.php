<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin - Aplikasi Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .btn-utama {
            background-color: rgb(253, 43, 148) !important;
            border-color: rgb(253, 43, 148) !important;
        }

        .btn-utama:hover {
            background-color: #f4a6b8 !important;
            border-color: #f4a6b8 !important;
        }

        .utama {
            background-color: rgb(253, 43, 148);
        }

        .kartu-statistik {
            border: none;
            border-left: 5px solid rgb(253, 43, 148);
            border-radius: 10px;
        }

        .angka-statistik {
            color: rgb(253, 43, 148);
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>
    {{-- Navbar --}}
    <nav class="navbar navbar-dark utama shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold">
                Aplikasi Sertifikasi
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold">Dashboard Admin</h2>
            <p class="text-muted">
                Selamat datang,
                <strong>{{ auth()->user()->name }}</strong>!
            </p>
        </div>

        {{-- Statistik --}}
        <div class="row g-3 mb-4">

            <div class="col-md-6">
                <div class="card kartu-statistik shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="text-muted">Total Peserta</h5>
                        <div class="angka-statistik">
                            {{ $totalPeserta }}
                        </div>
                        <p class="mb-0">Peserta terdaftar</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card kartu-statistik shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="text-muted">Total Skema Sertifikasi</h5>
                        <div class="angka-statistik">
                            {{ $totalSkema }}
                        </div>
                        <p class="mb-0">Skema tersedia</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Menu Pengelolaan --}}
        <h4 class="mb-3">Menu Pengelolaan</h4>

        <div class="row g-3">

            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5>Data Peserta</h5>
                        <p class="text-muted">
                            Lihat, tambah, edit, dan hapus data peserta sertifikasi.
                        </p>
                        <a href="{{ route('peserta.index') }}"
                           class="btn btn-utama text-white">
                            Kelola Peserta
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5>Skema Sertifikasi</h5>
                        <p class="text-muted">
                            Kelola data skema sertifikasi yang tersedia.
                        </p>
                        <a href="{{ route('skema.index') }}"
                           class="btn btn-utama text-white">
                            Kelola Skema
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
