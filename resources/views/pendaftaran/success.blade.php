<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<style>
    .btn-utama{
        background-color: rgb(253, 43, 148);
    }
    .btn-utama:hover{
        background-color: #f4a6b8;
    }
    .btn-kedua{
        background-color: #FFE962;
    }
    .btn-kedua:hover{
        background-color:#fff4ac;
    }
    .text-utama{
        color: rgb(253, 43, 148);
    }
</style>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5 text-center">

                    <div class="text-success mb-3">
                        <span style="font-size: 65px;">✓</span>
                    </div>

                    <h2 class="fw-bold">Pendaftaran Berhasil!</h2>

                    <p class="text-secondary mb-4">
                        Terima kasih telah mendaftar sertifikasi.
                        Data pendaftaran kamu berhasil disimpan.
                    </p>

                    <div class="alert alert-success">
                        Pendaftaran kamu telah tercatat di sistem.
                    </div>

                    <div class="text-start border rounded-3 p-3 mb-4">
                        <h5 class="fw-bold mb-3">Bukti Pendaftaran</h5>

                        <p class="mb-2">
                            <strong>No. Peserta:</strong>
                            {{ $peserta->no_peserta }}
                        </p>

                        <p class="mb-2">
                            <strong>Nama:</strong>
                            {{ $peserta->nama }}
                        </p>

                        <p class="mb-2">
                            <strong>NIK:</strong>
                            {{ $peserta->nik }}
                        </p>

                        <p class="mb-2">
                            <strong>Email:</strong>
                            {{ $peserta->email ?: '-' }}
                        </p>

                        <p class="mb-2">
                            <strong>Skema Sertifikasi:</strong>
                            {{ $skema->nama ?? 'Skema tidak ditemukan' }}
                        </p>

                        <p class="mb-0">
                            <strong>Status:</strong>
                            <span class="badge bg-success">Terdaftar</span>
                        </p>
                    </div>

                    <a href="{{ route('peserta.dashboard') }}"
                       class="btn btn-utama w-100 mb-2 text-white">
                        Lihat Dashboard Peserta
                    </a>

                    <button onclick="window.print()"
                            class="btn btn-kedua w-100">
                        Cetak Bukti Pendaftaran
                    </button>

                    <a href="{{ route('home') }}"
                       class="d-inline-block mt-3 text-decoration-none text-utama">
                        Kembali ke Beranda
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
```
