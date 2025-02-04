@extends('layouts.app')

@section('title', 'Profil Admin')

@section('content')
    <div class="container">
        <h1>Profil Admin</h1>
        <div>
            <strong>Nama:</strong> {{ $admin->namaadmin }}<br>
            <strong>Username:</strong> {{ $admin->username }}<br>
            <strong>Status:</strong> {{ ucfirst($admin->status) }}<br>
            <strong>Role:</strong> {{ ucfirst($admin->role) }}<br>
            @if($admin->foto)
                <strong>Foto:</strong><br>
                <img src="{{ asset('uploads/' . $admin->foto) }}" alt="Admin Foto" style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <strong>Foto:</strong> Tidak ada foto yang diupload.<br>
            @endif
        </div>
    </div>
@endsection
