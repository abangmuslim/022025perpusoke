<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- AdminLTE & Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .navbar-custom {
            background-color: #5D4037 !important;
            /* Dark Brown */
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: #ffffff !important;
        }

        .dropdown-menu {
            background-color: #ffffff !important;
            /* White */
        }

        .dropdown-menu a {
            color: #5D4037 !important;
            /* Dark Brown */
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }

        .content-wrapper {
            min-height: 100vh;
            /* Full screen height */
            padding: 20px;
        }

        body {
            overflow-x: hidden;
            /* Hilangkan scroll horizontal jika ada */
        }

        .wrapper,
        .content-wrapper,
        .main-header {
            margin-left: 0 !important;
            /* Hilangkan margin kiri */
            padding: 20px;
            /* Atur padding konten */
            width: 100% !important;
            /* Lebar penuh */
        }

        .main-header,
        .navbar {
            width: 100% !important;
            /* Navbar lebar penuh */
        }

        .sidebar-collapse .content-wrapper {
            margin-left: 0 !important;
            /* Pastikan margin kiri 0 saat sidebar collapse */
        }
    </style>
</head>

<body class="sidebar-collapse layout-top-nav">

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-custom">
        <a class="navbar-brand font-weight-bold" href="{{ route('dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Admin</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.index') }}">Index</a> <!-- Mengarahkan ke halaman admin index -->
                        <a class="dropdown-item" href="{{ route('admin.create') }}">Tambah</a> <!-- Mengarahkan ke halaman admin create -->
                        <a class="dropdown-item" href="#">Tampil</a> <!-- Dibiarkan kosong atau disesuaikan nanti -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Peminjam</a>
                    <div class="dropdown-menu">
                        @guest('peminjam')
                        <a class="dropdown-item" href="{{ route('peminjam.login') }}">Login Peminjam</a>
                        <a class="dropdown-item" href="{{ route('peminjam.register') }}">Registrasi Peminjam</a>
                        @else
                        <a class="dropdown-item" href="{{ route('peminjam.index') }}">Daftar Peminjam</a>
                        <a class="dropdown-item" href="{{ route('peminjam.create') }}">Tambah Peminjam</a>
                        <a class="dropdown-item" href="{{ route('peminjam.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('peminjam.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endguest
                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Buku</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Index</a>
                        <a class="dropdown-item" href="#">Tambah</a>
                        <a class="dropdown-item" href="#">Tampil</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Peminjaman</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Index</a>
                        <a class="dropdown-item" href="#">Tambah</a>
                        <a class="dropdown-item" href="#">Tampil</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Laporan/Rekap</a>
                </li>
            </ul>
        </div>
        <!-- User Info and Logout -->
        <div class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    @if(Auth::user()->foto)
                    <img src="{{ asset('uploads/' . Auth::user()->foto) }}" alt="Admin Photo" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;">
                    @else
                    <img src="{{ asset('path/to/default-photo.jpg') }}" alt="Admin Photo" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;">
                    @endif
                    <span>{{ Auth::user()->namaadmin }}</span>
                    <span class="badge badge-success">{{ ucfirst(Auth::user()->role) }}</span> <!-- Mengganti status dengan role -->
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile') }}">Profil</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </div>

    </nav>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}">
        $(document).ready(function() {
            $('body').addClass('sidebar-collapse'); // Collapse sidebar jika masih aktif
            $('.main-sidebar').remove(); // Hapus elemen sidebar jika ada
            $('.content-wrapper').css('margin-left', '0'); // Pastikan tidak ada margin kiri
        });
    </script>
</body>

</html>