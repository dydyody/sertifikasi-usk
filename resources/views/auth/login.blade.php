<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    .btn-utama{
        background-color: rgb(253, 43, 148) !important;
    }
    .btn-utama:hover{
        background-color: #f4a6b8 !important;
    }
    .btn-kedua{
        background-color: #FFE962 !important;
    }
    .btn-kedua:hover{
        background-color:#fff4ac !important;
    }
</style>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">
                            Aplikasi Sertifikasi
                        </h3>
                        <p class="text-muted mb-0">
                            Login
                        </p>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>
                            <input type="email" name="email" id="email" class="form-controll @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@gmail.com" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" required>
                        </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-utama flex-fill text-white">
                                    Login
                                </button>

                                <a href="{{ route('home') }}" class="btn btn-kedua flex-fill">
                                    Batal
                                </a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
