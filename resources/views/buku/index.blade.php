@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #1B03A3; color: white; font-weight: bold;">
        <h3 class="card-title">Daftar Buku</h3>
        <div class="card-tools">
            <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Buku</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Seri</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Rak</th>
                    <th>Status</th>
                    <th>Kondisi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nomorseri }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->kategori->namakategori }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->pengarang }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->rak }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ ucfirst($item->kondisi) }}</td>
                    <td>
                        @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" class="img-thumbnail" width="50">
                        @else
                        <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('buku.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form id="delete-form-{{ $item->id }}" action="{{ route('buku.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#bukuTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ entri",
                "search": "Cari:",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Berikutnya"
                }
            }
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Buku ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection