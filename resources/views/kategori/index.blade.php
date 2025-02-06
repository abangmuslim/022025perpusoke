@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kategori</h2>

    <!-- Form Tambah/Edit -->
    <button class="btn btn-primary mb-3" onclick="openModal()">+ Insert Data</button>

    <!-- Tabel DataTables -->
    <table id="kategoriTable" class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kategori</th>
                <th>Tanggal Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->namakategori }}</td>
                    <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editKategori({{ $item->id }}, '{{ $item->namakategori }}')">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteKategori({{ $item->id }})">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="kategoriForm">
                    @csrf
                    <input type="hidden" id="kategoriId">
                    <div class="mb-3">
                        <label for="kategoriNama" class="form-label">Nama Kategori</label>
                        <input type="text" id="kategoriNama" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#kategoriTable').DataTable();
});

// Buka modal untuk tambah/edit
function openModal() {
    $('#kategoriId').val('');
    $('#kategoriNama').val('');
    $('.modal-title').text('Tambah Kategori');
    $('#kategoriModal').modal('show');
}

// Edit kategori
function editKategori(id, nama) {
    $('#kategoriId').val(id);
    $('#kategoriNama').val(nama);
    $('.modal-title').text('Edit Kategori');
    $('#kategoriModal').modal('show');
}

// Submit form (Tambah/Edit)
$('#kategoriForm').submit(function(e) {
    e.preventDefault();
    let id = $('#kategoriId').val();
    let nama = $('#kategoriNama').val();
    let url = id ? '/kategori/' + id : '/kategori';
    let method = id ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        type: 'POST',
        data: { 
            _token: '{{ csrf_token() }}', 
            _method: method, 
            namakategori: nama 
        },
        success: function(response) {
            $('#kategoriModal').modal('hide');
            location.reload();
        },
        error: function(xhr) {
            alert('Gagal menyimpan data');
            console.log(xhr.responseText);
        }
    });
});

// Hapus kategori
function deleteKategori(id) {
    if (!confirm('Hapus kategori ini?')) return;

    $.ajax({
        url: '/kategori/' + id,
        type: 'POST',
        data: { 
            _token: '{{ csrf_token() }}', 
            _method: 'DELETE' 
        },
        success: function(response) {
            location.reload();
        },
        error: function(xhr) {
            alert('Gagal menghapus data');
            console.log(xhr.responseText);
        }
    });
}
</script>
@endsection
