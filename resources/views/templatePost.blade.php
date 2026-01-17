<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','User Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #111827;
        }

        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover, .sidebar .active {
            background: #2563eb;
            color: #fff;
        }

        .content {
            padding: 30px;
        }

        .card-stat {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
        }
    </style>
</head>
<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar p-3">
        <h4 class="text-white mb-4">
            <i class="fa-solid fa-blog me-2"></i> Blog Panel
        </h4>

        <a href="{{ route('posting.index',Auth::User()->id) }}" class="{{ request()->routeIs('posting.index') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line me-2"></i> Dashboard
        </a>

        <a href="{{ route('posting.add') }}" class="{{ request()->routeIs('posting.add') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper me-2"></i> Postingan
        </a>

        <a href="{{ route('profile.view',Auth::User()->id) }}" class="{{ request()->routeIs('profile.view') ? 'active' : '' }}">
            <i class="fa-solid fa-user-gear me-2"></i> Setting Profile
        </a>

        <hr class="text-secondary">

        <a href="{{ route('logout') }}">
            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
        </a>
    </div>

    {{-- CONTENT --}}
    <div class="flex-fill content">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
