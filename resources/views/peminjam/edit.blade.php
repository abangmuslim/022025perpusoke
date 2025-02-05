{{-- Halaman Edit --}}
@extends('layouts.app')

@section('title', 'Edit Peminjam')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Peminjam</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Peminjam</label>
                <input type="text" name="namapeminjam" class="form-control" value="{{ $peminjam->namapeminjam }}" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ $peminjam->username }}" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <select name="keterangan" class="form-control" required>
                    <option value="siswa" {{ $peminjam->keterangan == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="guru" {{ $peminjam->keterangan == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="umum" {{ $peminjam->keterangan == 'umum' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $peminjam->alamat }}" required>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control-file">
                @if($peminjam->foto)
                    <img src="{{ asset('storage/' . $peminjam->foto) }}" class="img-thumbnail mt-2" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
