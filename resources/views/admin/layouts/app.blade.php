<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - EcoTrack.ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: #ecf0f1;
    }

    .sidebar .nav-link {
        color: #ecf0f1;
        border-radius: 0;
    }

    .sidebar .nav-link.active {
        background-color: #3498db;
    }

    .sidebar .nav-link:hover {
        background-color: #34495e;
    }

    .content {
        flex-grow: 1;
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="sidebar d-flex flex-column p-3">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand text-white fs-4 mb-4">
            🌱 Admin EcoTrack
        </a>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i
                        class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('admin.reports.index') }}"
                    class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"><i
                        class="bi bi-flag"></i> Laporan</a></li>
            <li class="nav-item"><a href="{{ route('admin.green-points.index') }}"
                    class="nav-link {{ request()->routeIs('admin.green-points.*') ? 'active' : '' }}"><i
                        class="bi bi-geo-alt"></i> Titik Hijau</a></li>
            <li class="nav-item"><a href="{{ route('admin.articles.index') }}"
                    class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}"><i
                        class="bi bi-journal-text"></i> Artikel</a></li>
            <li class="nav-item"><a href="{{ route('admin.challenges.index') }}"
                    class="nav-link {{ request()->routeIs('admin.challenges.*') ? 'active' : '' }}"><i
                        class="bi bi-trophy"></i> Tantangan</a></li>
            <li class="nav-item"><a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i
                        class="bi bi-people"></i> Pengguna</a></li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown">
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Lihat Situs</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <main class="content bg-light">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div> @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div> @endif
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>