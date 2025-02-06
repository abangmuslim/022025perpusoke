@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Buku</h4>
        </div>
        <div class="card-body bg-white">
            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="idkategori" class="form-control">
                                @foreach($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->namakategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Seri</label>
                            <input type="text" name="nomorseri" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" class="form-control">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" name="tahun" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Rak</label>
                            <input type="text" name="rak" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="tersedia">Tersedia</option>
                                <option value="dipinjam">Dipinjam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kondisi</label>
                            <select name="kondisi" class="form-control">
                                <option value="bagus">Bagus</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="form-group text-right">
                    <br>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="{{ route('buku.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection