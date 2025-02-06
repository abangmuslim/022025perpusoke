@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Buku</h4>
        </div>
        <div class="card-body bg-white">
            <div class="row">
                <!-- Kolom Kiri: Foto Buku -->
                <div class="col-md-4 text-center">
                    <div>
                        <img src="{{ asset('storage/'.$buku->foto) }}" class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                    <div>
                        <a href="{{ route('buku.index') }}" class="btn btn-danger">Kembali</a>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                    </div>
                </div>

                <!-- Kolom Kanan: Informasi Buku -->
                <div class="col-md-4">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nomor Seri Buku</th>
                            <td>: {{ $buku->nomorseri }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>: {{ $buku->kategori->namakategori }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>: {{ $buku->judul }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>: {{ $buku->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>Pengarang</th>
                            <td>: {{ $buku->pengarang }}</td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td>: {{ $buku->tahun }}</td>
                        </tr>
                        <tr>
                            <th>Rak</th>
                            <td>: {{ $buku->rak }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: <span class="badge bg-{{ $buku->status == 'tersedia' ? 'success' : 'danger' }}">
                                    {{ ucfirst($buku->status) }}
                                </span></td>
                        </tr>
                        <tr>
                            <th>Kondisi</th>
                            <td>: <span class="badge bg-{{ $buku->kondisi == 'bagus' ? 'primary' : 'warning' }}">
                                    {{ ucfirst($buku->kondisi) }}
                                </span></td>
                        </tr>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection