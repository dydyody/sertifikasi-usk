
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fff5fa;
        }

        .navbar-utama {
            background-color: rgb(253, 43, 148);
        }

        .btn-utama {
            background-color: rgb(253, 43, 148);
            color: white;
        }

        .btn-utama:hover {
            background-color: #e91e83;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-utama">
    <div class="container">
        <span class="navbar-brand">Aplikasi Sertifikasi</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container py-5">
    <h2>Dashboard Peserta</h2>
    <p class="text-muted">
        Selamat datang,
        <strong>{{ auth()->user()->name }}</strong>!
    </p>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5>Pendaftaran Sertifikasi</h5>
                    <p class="text-muted">
                        Daftarkan diri untuk mengikuti skema sertifikasi.
                    </p>

                    <a href="{{ route('pendaftaran.create') }}"
                       class="btn btn-utama">
                        Daftar Sertifikasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
