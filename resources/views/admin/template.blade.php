<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('bootstrap1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/fontawesome-free-6.7.2-web/css/all.min.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        /* SIDEBAR DESKTOP */
        .sidebar {
            height: 100vh;
            background-color: #24b7cb;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding: 0;
        }

        .sidebar .nav-link {
            padding: 14px 20px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.2);
        }

        .sidebar .nav-link.active {
            background-color: #fff;
            color: #24b7cb;
            font-weight: bold;
            border-left: 5px solid #0d6efd;
        }

        .sidebar i {
            width: 22px;
            text-align: center;
        }

        /* MAIN */
        main {
            margin-left: 250px;
        }

        /* MOBILE */
        @media (max-width: 767px) {
            main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

@php
    $unreadCount = App\Models\Kontak::where('status','belum terbaca')->count();
@endphp

{{-- NAVBAR MOBILE --}}
<nav class="navbar navbar-light bg-white d-md-none shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
            <i class="fa-solid fa-bars"></i>
        </button>
        <span class="fw-bold">foodtesty Admin</span>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR DESKTOP --}}
        <nav class="sidebar d-none d-md-block">
            <div class="py-4 text-center border-bottom">
                <h4 class="text-white fw-bold">foodtesty</h4>
            </div>

            <ul class="navbar-nav mt-3">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.home*') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.berita*') ? 'active' : '' }}" href="{{ route('admin.berita') }}">
                        <i class="fa-solid fa-newspaper"></i> Daftar Berita
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.galeri*') ? 'active' : '' }}" href="{{ route('admin.galeri') }}">
                        <i class="fa-solid fa-images"></i> Galeri
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.masukan*') ? 'active' : '' }}" href="{{ route('admin.masukan') }}">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        Masukan
                        @if($unreadCount > 0)
                            <span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.perusahaan*') ? 'active' : '' }}" href="{{ route('admin.perusahaan') }}">
                        <i class="fa-solid fa-building"></i> Tentang Perusahaan
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a class="nav-link" href="{{ route('logout.admin') }}">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        {{-- MAIN CONTENT --}}
        <main class="col px-4 py-4">
            <h2 class="mb-4">@yield('title')</h2>
            @yield('content')
        </main>
    </div>
</div>

{{-- OFFCANVAS SIDEBAR MOBILE --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMobile">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title">foodtesty Admin</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link px-3" href="{{ route('admin.home') }}">
                    <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link px-3" href="{{ route('admin.berita') }}">
                    <i class="fa-solid fa-newspaper me-2"></i> Berita
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link px-3" href="{{ route('admin.galeri') }}">
                    <i class="fa-solid fa-images me-2"></i> Galeri
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link px-3" href="{{ route('admin.masukan') }}">
                    <i class="fa-solid fa-envelope-open-text me-2"></i>
                    Masukan
                    @if($unreadCount > 0)
                        <span class="badge bg-danger">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link px-3" href="{{ route('admin.perusahaan') }}">
                    <i class="fa-solid fa-building me-2"></i> Tentang Perusahaan
                </a>
            </li>

            <li class="nav-item mt-3">
                <a class="nav-link px-3 text-danger" href="{{ route('logout.admin') }}">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<script src="{{ asset('bootstrap1/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
