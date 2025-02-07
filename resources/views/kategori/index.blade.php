@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #1B03A3; color: white; font-weight: bold;">
        <h3 class="card-title">Daftar Kategori</h3>
        <div class="card-tools">
            <button class="btn btn-primary btn-sm" onclick="openModal()"><i class="fas fa-plus"></i> Tambah Kategori</button>
        </div>
    </div>

    <!-- Form Tambah/Edit -->
    <div class="card-body">
        <!-- Tabel DataTables -->
        <table id="example1" class="table table-bordered">
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
                        <!-- Tombol Tampilkan -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Tampilkan"
                            onclick="showKategori({{ $item->id }}, {{ json_encode($item->namakategori) }}, '{{ $item->created_at->format('d M Y, H:i') }}')">
                            <i class="fas fa-eye"></i>
                        </button>

                        <!-- Tombol Edit -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit"
                            onclick="editKategori({{ $item->id }}, {{ json_encode($item->namakategori) }})">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Tombol Hapus dengan SweetAlert -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus"
                            onclick="confirmDelete({{ $item->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tampilkan Kategori -->
<div class="modal fade" id="showKategoriModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">ID</th>
                        <td>: <span id="showKategoriId"></span></td>
                    </tr>
                    <tr>
                        <th>Nama Kategori</th>
                        <td>: <span id="showKategoriNama"></span></td>
                    </tr>
                    <tr>
                        <th>Tanggal Input</th>
                        <td>: <span id="showKategoriTanggal"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah/Edit -->
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

<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });

    // Inisialisasi modal secara benar
    var kategoriModal = new bootstrap.Modal(document.getElementById('kategoriModal'));
    var showKategoriModal = new bootstrap.Modal(document.getElementById('showKategoriModal'));

    // Buka modal untuk tambah/edit
    function openModal() {
        $('#kategoriId').val('');
        $('#kategoriNama').val('');
        $('.modal-title').text('Tambah Kategori');
        kategoriModal.show();
    }

    // Tampilkan kategori
    function showKategori(id, nama, tanggal) {
        $('#showKategoriId').text(id);
        $('#showKategoriNama').text(nama);
        $('#showKategoriTanggal').text(tanggal);
        showKategoriModal.show();
    }

    // Edit kategori
    function editKategori(id, nama) {
        $('#kategoriId').val(id);
        $('#kategoriNama').val(nama);
        $('.modal-title').text('Edit Kategori');
        kategoriModal.show();
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
                kategoriModal.hide();
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

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke route penghapusan atau panggil fungsi deleteKategori
                deleteKategori(id);
            }
        });
    }

    function deleteKategori(id) {
        // Kirim permintaan penghapusan via AJAX
        fetch(`/kategori/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Terhapus!', 'Data kategori telah dihapus.', 'success');
                    location.reload(); // Reload halaman setelah hapus
                } else {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.', 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan dalam koneksi.', 'error');
            });
    }
</script>
@endsection