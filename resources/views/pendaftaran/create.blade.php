
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sertifikasi</title>

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
            border: none;
        }

        .btn-utama:hover {
            background-color: #e91e83;
            color: white;
        }

        .card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-utama">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            Aplikasi Sertifikasi
        </a>

        <a href="{{ route('home') }}" class="btn btn-light btn-sm">
            Kembali
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-center mb-2">Formulir Pendaftaran</h3>
                    <p class="text-muted text-center mb-4">
                        Silakan lengkapi data untuk mengikuti sertifikasi.
                    </p>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa kembali data kamu:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nomor Peserta</label>
                            <input
                                type="text"
                                name="no_peserta"
                                class="form-control"
                                value="{{ old('no_peserta') }}"
                                maxlength="50"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                value="{{ old('nama') }}"
                                maxlength="50"
                                pattern="[\p{L}\s'-]+"
                                title="Nama hanya boleh berisi huruf, spasi, tanda petik satu, dan tanda hubung."
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIK (16 digit)</label>
                            <input
                                type="text"
                                name="nik"
                                class="form-control"
                                value="{{ old('nik') }}"
                                inputmode="numeric"
                                pattern="[0-9]{16}"
                                minlength="16"
                                maxlength="16"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                maxlength="50"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input
                                type="text"
                                name="no_hp"
                                class="form-control"
                                value="{{ old('no_hp') }}"
                                inputmode="numeric"
                                maxlength="20"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea
                                name="alamat"
                                class="form-control"
                                rows="3"
                            >{{ old('alamat') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pilih Skema Sertifikasi</label>
                            <select
                                name="skema_sertifikasi_id"
                                class="form-select"
                                required
                            >
                                <option value="">-- Pilih Skema --</option>

                                @foreach ($skemas as $skema)
                                    <option
                                        value="{{ $skema->id }}"
                                        {{ old('skema_sertifikasi_id') == $skema->id ? 'selected' : '' }}
                                    >
                                        {{ $skema->kode }} - {{ $skema->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-utama w-100">
                            Kirim Pendaftaran
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
