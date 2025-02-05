@extends('layouts.app')

@section('title', 'Tambah Peminjam')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Peminjam</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('peminjam.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Peminjam</label>
                <input type="text" name="namapeminjam" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
