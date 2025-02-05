@extends('layouts.app')

@section('title', 'Edit Peminjam')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Peminjam</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST">
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
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
