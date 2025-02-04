@extends('layouts.app')

@section('title', 'Detail Admin')

@section('content_header')
<h1>Detail Admin</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informasi Admin</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Kolom Foto di sebelah kiri -->
            <div class="col-md-4 text-center">
                <strong>Foto:</strong><br>
                @if($admin->foto)
                <img src="{{ asset('uploads/' . $admin->foto) }}" width="150" class="img-fluid rounded shadow-sm">
                @else
                <p>Foto tidak tersedia</p>
                @endif
            </div>

            <!-- Kolom Keterangan di sebelah kanan dalam bentuk tabel -->
            <div class="col-md-4">
                <h2>Detail Admin</h2>
                <p><strong>Nama:</strong> {{ $admin->namaadmin }}</p>
                <p><strong>Username:</strong> {{ $admin->username }}</p>
                <p><strong>Role:</strong>

                    @if($admin->role == 'admin')
                    <span class="badge badge-danger">{{ ucfirst($admin->role) }}</span>
                    @elseif($admin->role == 'petugas')
                    <span class="badge badge-warning">{{ ucfirst($admin->role) }}</span>
                    @else
                    <span class="badge badge-secondary">{{ ucfirst($admin->role) }}</span>
                    @endif
                </p>
                <p><strong>Status:</strong>
                @if ($admin->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                        @elseif ($admin->status == 'setujui')
                        <span class="badge badge-success">Disetujui</span>
                        @elseif ($admin->status == 'tolak')
                        <span class="badge badge-danger">Ditolak</span>
                        @endif
                </p>
            </div>
            <div class="col-md-4">
                <h2>Aksi</h2>
                @if ($admin->status == 'pending')
                <form action="{{ route('admin.approve', $admin->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit">Setujui</button>
                </form>
                <form action="{{ route('admin.reject', $admin->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit">Tolak</button>
                </form>
                @endif

            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Kembali ke Daftar Admin</a>
    </div>
</div>
@endsection