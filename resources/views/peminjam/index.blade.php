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
                        <th>Keterangan</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Confirm</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjam as $p)
                    <tr>
                        <td>{{ $p->namapeminjam }}</td>
                        <td>{{ $p->username }}</td>
                        <td>{{ ucfirst($p->keterangan) }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>
                            @if($p->foto)
                            <img src="{{ asset('storage/' . $p->foto) }}" alt="Foto Peminjam" width="50">
                            @else
                            Tidak ada foto
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $p->status == 'pending' ? 'badge-warning' : ($p->status == 'setujui' ? 'badge-success' : 'badge-danger') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            <!-- Tombol Setujui & Tolak (jika status pending) -->
                            @if ($p->status == 'pending')
                            <form action="{{ route('peminjam.approve', $p->id) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm" title="Setujui">
                                    <i class="fas fa-check"></i> <!-- Ikon centang hijau -->
                                </button>
                            </form>
                            <form action="{{ route('peminjam.reject', $p->id) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-secondary btn-sm" title="Tolak">
                                    <i class="fas fa-times"></i> <!-- Ikon silang abu-abu -->
                                </button>
                            </form>
                            @endif
                        </td>
                        <td>
                            <!-- Tombol Lihat -->
                            <a href="{{ route('peminjam.show', $p->id) }}" class="btn btn-info btn-sm" title="Lihat">
                                <i class="fas fa-eye"></i> <!-- Ikon mata -->
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('peminjam.edit', $p->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i> <!-- Ikon pensil -->
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('peminjam.destroy', $p->id) }}" method="POST" class="d-inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus">
                                    <i class="fas fa-trash"></i> <!-- Ikon tempat sampah -->
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<script>
    function confirmDelete(adminId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data admin akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + adminId).submit();
            }
        });
    }
</script>