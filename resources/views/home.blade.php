
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fff5fa;
        }

        .navbar-utama {
            background-color: rgb(253, 43, 148);
        }

        .btn-register {
            background-color: rgb(253, 43, 148);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-register:hover {
            background-color: #e91e83;
            color: white;
        }

        .hero {
            padding: 100px 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-utama">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            Aplikasi Sertifikasi
        </a>

        <div>
            <a href="{{ route('login') }}" class="btn btn-light btn-sm">
                Login
            </a>

            <a href="{{ route('pendaftaran.create') }}" class="btn btn-outline-light btn-sm ms-2">
                Daftar Akun
            </a>
        </div>
    </div>
</nav>

<section class="hero container">
    <h1>Selamat Datang di Aplikasi Sertifikasi</h1>
    <p class="text-muted mt-3">
        Daftarkan diri Anda untuk mengikuti program sertifikasi.
    </p>

    <a href="{{ route('pendaftaran.create') }}" class="btn-register mt-3">
        Daftar Sertifikasi
    </a>
</section>

</body>
</html>
