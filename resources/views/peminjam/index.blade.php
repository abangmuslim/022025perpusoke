@extends('layouts.app')

@section('title', 'Daftar Peminjam')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #1B03A3; color: white; font-weight: bold;">
        <h3 class="card-title">Daftar Peminjam</h3>
        <div class="card-tools">
            <a href="{{ route('peminjam.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Peminjam</a>
            <a href="{{ route('peminjam.export') }}" class="btn btn-success btn-sm">Export Excel</a>

            <form action="{{ route('peminjam.import') }}" method="POST" enctype="multipart/form-data" style="display:inline-block;">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-primary btn-sm">Import Excel</button>
            </form>

        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Keterangan</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Confirm</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjam as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->namapeminjam }}</td>
                    <td>{{ $p->username }}</td>
                    <td>{{ ucfirst($p->keterangan) }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        @if($p->foto)
                        <img src="{{ asset('storage/' . $p->foto) }}" class="img-thumbnail" width="50">
                        @else
                        <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $p->status == 'pending' ? 'badge-warning' : ($p->status == 'setujui' ? 'badge-success' : 'badge-danger') }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($p->status == 'pending')
                        <form action="{{ route('peminjam.approve', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form action="{{ route('peminjam.reject', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('peminjam.show', $p->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('peminjam.edit', $p->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form id="delete-form-{{ $p->id }}" action="{{ route('peminjam.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $p->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection