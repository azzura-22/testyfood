<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('bootstrap1/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/fontawesome-free-6.7.2-web/css/all.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    {{-- Modal --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>



    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #24b7cb;
            position: fixed;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #ffffff;
        }
        .sidebar .nav-link.active {
            background-color: #ffffff;
            color: #24b7cb;
            font-weight: bold;
        }
    </style>
</head>
<body>
    @php
        $unreadCount = App\Models\Kontak::where('status','belum terbaca')->count();
    @endphp
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar d-none d-md-block">
            <div class="py-4 text-center">
                <h4 class="text-white">foodtesty</h4>
            </div>
                <ul class="navbar-nav me-auto">

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center  {{ Route::is('admin.home*') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                            <i class="fa-solid fa-gauge-high me-2"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center  {{ Route::is('admin.berita*') ? 'active' : '' }}" href="{{ route('admin.berita') }}">
                            <i class="fa-solid fa-newspaper me-2"></i>
                            Daftar Berita
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="{{route('admin.galeri')}}">
                            <i class="fa-solid fa-images me-2"></i>
                            Galeri
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center position-relative">
                        <a class="nav-link d-flex align-items-center  {{ Route::is('admin.masukan*') ? 'active' : '' }}" href="{{ route('admin.masukan') }}">
                            <i class="fa-solid fa-envelope-open-text me-2"></i>
                            Masukan
                            @if($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle
                                            badge rounded-pill bg-danger"
                                    style="width:10px; height:10px; padding:0;">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="#">
                            <i class="fa-solid fa-comments me-2"></i>
                            Komentar
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center {{ Route::is('admin.perusahaan*') ? 'active' : '' }}" href="{{route('admin.perusahaan')}}">
                            <i class="fa-solid fa-building me-2"></i>
                            Tentang Perusahaan
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="{{ route('logout.admin') }}">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>
                            Logout
                        </a>
                    </li>

                </ul>

        </nav>
        <main class="col-md-10 ms-sm-auto px-4 py-4">
            <h2 class="mb-4">@yield('title')</h2>
            @yield('content')
        </main>
    </div>
</div>
    <footer class="footer mt-auto py-3 fixed-bottom d-flex justify-content-center">
        <div class="container text-center">
            <span>&copy; {{ date('Y') }} foodtesty</span>
        </div>
    </footer>
<script src="{{asset('bootstrap1/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
