@extends('layouts.app')

@section('title', 'Daftar Peminjam')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Daftar Peminjam</h3>
            <a href="{{ route('peminjam.create') }}" class="btn btn-success">Tambah Peminjam</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjam as $p)
                    <tr>
                        <td>{{ $p->namapeminjam }}</td>
                        <td>{{ $p->username }}</td>
                        <td>
                            <span class="badge {{ $p->status == 'pending' ? 'badge-warning' : ($p->status == 'approved' ? 'badge-success' : 'badge-danger') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('peminjam.show', $p->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('peminjam.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('peminjam.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjam ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            @if ($p->status == 'pending')
                                <form action="{{ route('peminjam.approve', $p->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>
                                <form action="{{ route('peminjam.reject', $p->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-secondary btn-sm">Tolak</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
