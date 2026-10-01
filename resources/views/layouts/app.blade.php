<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Aplikasi Sertifikasi')
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="d-flex">
    {{-- SIDEBAR --}}
    <aside class="sidebar bg-dark text-white">
        <div class="sidebar-header p-3 border-bottom border-secondary">
            <h5 class="mb-0">
                Sertifikasi
            </h5>
            <small class="text-secondary">
                Administrator
            </small>
        </div>
        <div class="p-3">
            <ul class="nav nav-pills flex-column gap-2">
                <li class="nav-item">
                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link text-white
                        {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    >
                        <span class="me-2">📊</span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        href="{{route('peserta.index')}}"
                        class="nav-link text-white"
                    >
                        <span class="me-2">👥</span>
                        Data Peserta
                    </a>
                </li>
                <li class="nav-item">
                <a
                    href="{{ route('skema.index') }}"
                    class="nav-link text-white
                    {{ request()->routeIs('skema.*') ? 'active' : '' }}"
                >
                    <span class="me-2">📋</span>
                    Skema Sertifikasi
                </a>
                </li>
            </ul>
        </div>
    </aside>
    {{-- MAIN CONTENT --}}
    <div class="main-content flex-grow-1">
        {{-- NAVBAR --}}
        <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand fw-semibold">
                    @yield('page-title', 'Dashboard')
                </span>
                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted">
                        {{ auth()->user()->name }}
                    </span>
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-outline-danger btn-sm"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        {{-- CONTENT --}}
        <main class="p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>