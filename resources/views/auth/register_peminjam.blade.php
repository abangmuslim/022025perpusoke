<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Peminjam | AdminLTE</title>

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Perpustakaan</b>App</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Daftar sebagai Peminjam</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peminjam.register.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="namapeminjam">Nama Lengkap</label>
                        <input type="text" name="namapeminjam" class="form-control" placeholder="Masukkan Nama" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </form>

                <p class="mt-3 text-center">
                    Kembali ke halaman <a href="{{ route('peminjam.login') }}" class="text-primary font-weight-bold">LOGIN</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
