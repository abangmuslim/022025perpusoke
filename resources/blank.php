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
                        <a class="dropdown-item" href="{{ route('admin.index') }}">Daftar Admin</a> <!-- Mengarahkan ke halaman admin index -->
                        <a class="dropdown-item" href="{{ route('admin.create') }}">Tambah</a> <!-- Mengarahkan ke halaman admin create -->
                        <a class="dropdown-item" href="#">Tampil</a> <!-- Dibiarkan kosong atau disesuaikan nanti -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Peminjam</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('peminjam.index') }}">Daftar Peminjam</a>
                        <a class="dropdown-item" href="{{ route('peminjam.create') }}">Tambah Peminjam</a>
                        <div class="dropdown-divider"></div>
                        <div class="px-3">
                            <a class="btn btn-success btn-block text-white font-weight-bold" style="color: white !important;" href="{{ route('login') }}">
                                Login
                            </a>
                            <a class="btn btn-danger btn-block text-white font-weight-bold mt-2" style="color: white !important;" href="{{ route('register') }}">
                                Registrasi
                            </a>
                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Buku</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('buku.index') }}">Daftar Buku</a>
                        <a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori</a>
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
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">Profil</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </div>

    </nav>