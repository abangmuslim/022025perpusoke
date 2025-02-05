@extends('layouts.app')

@section('title', 'Detail Peminjam')

@section('content_header')
<h1>Detail Peminjam</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informasi Peminjam</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Kolom Foto di sebelah kiri -->
            <div class="col-md-4 text-center">
                <strong>Foto:</strong><br>
                @if($peminjam->foto)
                <img src="{{ asset('storage/' . $peminjam->foto) }}" width="300" class="img-fluid rounded shadow-sm">
                @else
                <p>Foto tidak tersedia</p>
                @endif
            </div>

            <!-- Kolom Keterangan di sebelah kanan dalam bentuk tabel -->
            <div class="col-md-4">
                <h2>Detail Peminjam</h2>
                <p><strong>Nama:</strong> {{ $peminjam->namapeminjam }}</p>
                <p><strong>Username:</strong> {{ $peminjam->username }}</p>
                <p><strong>Keterangan:</strong> {{ ucfirst($peminjam->keterangan) }}</p>
                <p><strong>Alamat:</strong> {{ $peminjam->alamat }}</p>
                <p><strong>Status:</strong>
                    @if ($peminjam->status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                    @elseif ($peminjam->status == 'setujui')
                    <span class="badge badge-success">Disetujui</span>
                    @elseif ($peminjam->status == 'tolak')
                    <span class="badge badge-danger">Ditolak</span>
                    @endif
                </p>
            </div>
            <div class="col-md-4">
                <h2>Aksi</h2>
                @if ($peminjam->status == 'pending')
                <form action="{{ route('peminjam.approve', $peminjam->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success" title="Setujui">
                        <i class="fas fa-check"></i> <!-- Ikon centang hijau -->
                    </button>
                </form>
                <form action="{{ route('peminjam.reject', $peminjam->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger" title="Tolak">
                        <i class="fas fa-times"></i> <!-- Ikon silang merah -->
                    </button>
                </form>
                @endif
            </div>

        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('peminjam.index') }}" class="btn btn-primary">Kembali ke Daftar Peminjam</a>
    </div>
</div>
@endsection