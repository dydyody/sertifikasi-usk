<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">
            Aplikasi Sertifikasi
        </span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
</nav>
<div class="containey py-4">
    <div class="mb-4">
        <h2>Dashboard</h2>
        <p class="text-muted">
            Selamat Datang,
            <strong>{{ auth()->user()->name }}</strong>
        </p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Data Peserta</h5>
                    <p class="text-muted">
                        Kelola Data Peserta Sertifikasi
                    </p>
                    <a href="#" class="btn btn-primary">Kelola Peserta</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Skema Sertifikasi</h5>
                    <p class="text-muted">Kelola Data Skema Sertifikasi.</p>
                    <a href="#" class="btn btn-primary">Kelola Skema</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
