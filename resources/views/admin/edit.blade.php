@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Admin</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="namaadmin">Nama</label>
                <input type="text" name="namaadmin" id="namaadmin" class="form-control" value="{{ $admin->namaadmin }}" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $admin->username }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control-file">
                @if ($admin->foto)
                    <div class="mt-2">
                        <img src="{{ asset('uploads/' . $admin->foto) }}" alt="Foto Admin" width="100">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $admin->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $admin->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ $admin->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
