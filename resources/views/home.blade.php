<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Sertifikasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

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

        .btn-kedua {
            background-color: #FFE962;
        }

        .btn-register:hover {
            background-color: #e91e83;
            color: white;
        }

        .hero {
            padding: 60px 20px;
            text-align: center;
        }

        /* Carousel Bootstrap */
        #carouselSertifikasi {
            max-width: 900px;
            margin: 30px auto;
        }

        #carouselSertifikasi {
            width:95%
            max-width: 1100px;
            margin: 35px auto 10px;
        }

        #carouselSertifikasi .carousel-item img {
            display: block;
            width: 100%;
            height: auto;
            aspect-ratio: 628 / 408;
            height: auto;
            object-fit: cover;
            border-radius: 12px;
        }

        @media (max-width: 768px) {
            #carouselSertifikasi {
                width: 95%;
                margin: 20px auto;
            }
        }


        @media (max-width: 768px) {
            #carouselSertifikasi {
                max-width: 90%;
                margin: 20px auto;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR ASLI --}}
    <nav class="navbar navbar-dark navbar-utama">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                Aplikasi Sertifikasi
            </a>

            <div>
                <a href="{{ route('login') }}"
                   class="btn btn-kedua btn-sm">
                    Login
                </a>

                <a href="{{ route('pendaftaran.create') }}"
                   class="btn btn-outline-light btn-sm ms-2">
                    Daftar Akun
                </a>
            </div>
        </div>
    </nav>

    {{-- CAROUSEL BOOTSTRAP --}}
    <div id="carouselSertifikasi"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="4000">

        <div class="carousel-inner">

            {{-- SLIDE 1 --}}
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/foto-usk1.jpg') }}"
                     class="d-block w-100"
                     alt="Foto USK 1">
            </div>

            {{-- SLIDE 2 --}}
            <div class="carousel-item">
                <img src="{{ asset('assets/images/foto-usk2.jpg') }}"
                     class="d-block w-100"
                     alt="Foto USK 2">
            </div>

        </div>

        {{-- TOMBOL PREVIOUS --}}
        <button class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselSertifikasi"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon"
                  aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        {{-- TOMBOL NEXT --}}
        <button class="carousel-control-next"
                type="button"
                data-bs-target="#carouselSertifikasi"
                data-bs-slide="next">
            <span class="carousel-control-next-icon"
                  aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>

    {{-- BAGIAN SAMBUTAN ASLI --}}
    <section class="hero container">
        <h1>Selamat Datang di Aplikasi Sertifikasi</h1>

        <p class="text-muted mt-3">
            Daftarkan diri Anda untuk mengikuti program sertifikasi.
        </p>

        <a href="{{ route('pendaftaran.create') }}"
           class="btn-register mt-3">
            Daftar Sertifikasi
        </a>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
