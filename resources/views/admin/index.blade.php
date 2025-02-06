@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #1B03A3; color: white; font-weight: bold;">
        <h3 class="card-title">Daftar Admin</h3>
        <div class="card-tools">
            <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Admin</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Foto</th>
                    <th>Confirm</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $index => $admin)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $admin->namaadmin }}</td>
                    <td>{{ $admin->username }}</td>
                    <td>
                        @if ($admin->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                        @elseif ($admin->status == 'setujui')
                        <span class="badge badge-success">Disetujui</span>
                        @elseif ($admin->status == 'tolak')
                        <span class="badge badge-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if($admin->role == 'admin')
                        <span class="badge badge-danger">{{ ucfirst($admin->role) }}</span>
                        @elseif($admin->role == 'petugas')
                        <span class="badge badge-warning">{{ ucfirst($admin->role) }}</span>
                        @else
                        <span class="badge badge-secondary">{{ ucfirst($admin->role) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($admin->foto)
                        <img src="{{ asset('uploads/' . $admin->foto) }}" class="img-thumbnail" width="50">
                        @else
                        <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>
                        @if ($admin->status == 'pending')
                        <form action="{{ route('admin.approve', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.reject', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.show', $admin->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $admin->id }}">
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
