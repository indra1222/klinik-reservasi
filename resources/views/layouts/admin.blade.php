<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Klinik Reservasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: #ced4da;
        }
        .sidebar a:hover {
            color: #fff;
            background-color: #495057;
        }
        .sidebar .active {
            color: #fff;
            background-color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}" href="{{ route('admin.dokter.index') }}">
                                <i class="fas fa-user-md me-2"></i>
                                Kelola Dokter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reservasi.*') ? 'active' : '' }}" href="{{ route('admin.reservasi.index') }}">
                                <i class="fas fa-calendar-check me-2"></i>
                                Kelola Reservasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.trash.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#trashSubmenu">
                                <i class="fas fa-trash-alt me-2"></i>
                                Sampah
                            </a>
                            <div class="collapse {{ request()->routeIs('admin.trash.*') ? 'show' : '' }}" id="trashSubmenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.trash.dokter') ? 'active' : '' }}" href="{{ route('admin.trash.dokter') }}">Dokter</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.trash.reservasi') ? 'active' : '' }}" href="{{ route('admin.trash.reservasi') }}">Reservasi</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item mt-5">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn nav-link w-100 text-start">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>