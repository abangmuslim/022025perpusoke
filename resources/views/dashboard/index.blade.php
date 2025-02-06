@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-primary shadow">
                <div class="card-body">
                    <h5 class="card-title text-primary">Data Admin</h5>
                    <p class="card-text display-4">{{ $adminCount ?? 0 }}</p> <!-- Menampilkan jumlah admin -->
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-success shadow">
                <div class="card-body">
                    <h5 class="card-title text-success">Data Peminjam</h5>
                    <p class="card-text display-4">{{ $peminjamCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-warning shadow">
                <div class="card-body">
                    <h5 class="card-title text-warning">Data Buku</h5>
                    <p class="card-text display-4">{{ $bukuCount ?? 0 }}</p> <!-- Perbaikan -->
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card border-danger shadow">
                <div class="card-body">
                    <h5 class="card-title text-danger">Data Peminjaman</h5>
                    <p class="card-text display-4">{{ $peminjamanCount ?? 0 }}</p> <!-- Perbaikan -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
