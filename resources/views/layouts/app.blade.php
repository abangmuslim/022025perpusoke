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

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    <style>
        .navbar-custom {
            background-color: #0D47A1 !important;
            /* Biru Tua */
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: #FFFFFF !important;
            /* Putih Cerah */
        }

        .dropdown-menu {
            background-color: #BBDEFB !important;
            /* Biru Muda */
        }

        .dropdown-menu a {
            color: #000000 !important;
            /* Hitam */
        }

        .dropdown-menu a:hover {
            background-color: #1976D2 !important;
            /* Warna Hover Kontras */
            color: #FFFFFF !important;
        }

        /* Kategori Menu */
        .kategori-menu {
            background-color: #1976D2 !important;
            /* Biru Tua */
            color: #FFFFFF !important;
            /* Teks Putih */
            padding: 8px 12px;
            border-radius: 8px;
            /* Agar lebih smooth */
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Efek transisi smooth */
        }

        /* Hover Kategori: Berubah jadi Biru Muda */
        .kategori-menu:hover {
            background-color: #BBDEFB !important;
            /* Biru Muda */
            color: #000000 !important;
            /* Teks jadi hitam agar kontras */
            border: 1px solid #1976D2 !important;
        }

        /* Badge Custom */
        .kategori-menu .badge {
            background-color: #FFC107;
            /* Warna badge kuning agar kontras */
            color: #000000;
            /* Warna teks badge */
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 8px;
        }

        /* Agar submenu muncul dengan benar */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
            display: none;
            position: absolute;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        /* Badge lebih besar */
        .badge-custom {
            font-size: 16px;
            /* Perbesar teks badge */
            padding: 10px 15px;
            /* Tambahkan padding */
            border-radius: 8px;
            /* Bikin lebih smooth */
            background-color: #FFC107 !important;
            /* Warna kuning */
            color: #000 !important;
            /* Warna teks hitam */
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
        <a class="navbar-brand font-weight-bold ml-3" href="{{ route('dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Admin</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.index') }}">Daftar Admin</a>
                        <a class="dropdown-item" href="{{ route('admin.create') }}">Tambah</a>
                        <a class="dropdown-item" href="#">Tampil</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Peminjam</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('peminjam.index') }}">Daftar Peminjam</a>
                        <a class="dropdown-item" href="{{ route('peminjam.create') }}">Tambah Peminjam</a>
                        <div class="dropdown-divider"></div>
                        <div class="px-3">
                            <a class="btn btn-success btn-block text-white font-weight-bold" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-danger btn-block text-white font-weight-bold mt-2" href="{{ route('register') }}">Registrasi</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Buku</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('buku.index') }}">Daftar Buku</a>
                        <a class="dropdown-item" href="#">Tambah</a>
                        <a class="dropdown-item" href="#">Tampil</a>

                        <!-- Submenu -->
                        <div class="dropdown-submenu">
                            <a class="dropdown-item kategori-menu dropdown-toggle text-white font-weight-bold" href="#" data-toggle="dropdown">
                                <span class="badge badge-custom">KATEGORI BUKU >></span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('kategori.index') }}">Daftar Kategori</a>
                                <a class="dropdown-item" href="{{ route('kategori.create') }}">Tambah Kategori</a>
                            </div>
                        </div>

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
        <div class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    @if(Auth::user()->foto)
                    <img src="{{ asset('uploads/' . Auth::user()->foto) }}" alt="Admin Photo" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;">
                    @else
                    <img src="{{ asset('path/to/default-photo.jpg') }}" alt="Admin Photo" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;">
                    @endif
                    <span>{{ Auth::user()->namaadmin }}</span>
                    <span class="badge badge-success">{{ ucfirst(Auth::user()->role) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">Profil</a>
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


    <!-- DataTables & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    
    <!-- DataTables & Plugins Bootstrap 5-->
    <script src="{{ asset('plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap5.min.js') }}"></script>




    <!-- Tambahkan script SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    let form = this.closest('form');

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data akan dihapus secara permanen!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Jika dikonfirmasi, form akan dikirim
                        }
                    });
                });
            });
        });
    </script>
    <!-- Tambahkan script Dropdown Navbar -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e) {
                if (!$(this).next('div').hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                }
                var $subMenu = $(this).next("div");
                $subMenu.toggleClass('show');

                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function() {
                    $('.dropdown-submenu .dropdown-menu').removeClass("show");
                });
                return false;
            });
        });
    </script>

    <!-- Tambahkan script Data Table -->
    <script>
        $(document).ready(function() {
            let table = $('#example1').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"], // Tombol Export
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data tersedia",
                    "search": "Cari:",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya"
                    }
                }
            });

            // Tempatkan tombol di dalam container yang benar untuk Bootstrap 5
            table.buttons().container().appendTo('#example1_wrapper .dt-buttons');
        });
    </script>

</body>

</html>