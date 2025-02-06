@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Buku</h4>
        </div>
        <div class="card-body bg-white">
            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="idkategori" class="form-control">
                                @foreach($kategori as $item)
                                <option value="{{ $item->id }}" {{ $buku->idkategori == $item->id ? 'selected' : '' }}>{{ $item->namakategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Seri</label>
                            <input type="text" name="nomorseri" class="form-control" value="{{ $buku->nomorseri }}">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}">
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit }}">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control">
                            @if($buku->foto)
                            <br>
                            <img src="{{ asset('storage/' . $buku->foto) }}" width="100" alt="Foto Buku">
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" name="tahun" class="form-control" value="{{ $buku->tahun }}">
                        </div>
                        <div class="form-group">
                            <label>Rak</label>
                            <input type="text" name="rak" class="form-control" value="{{ $buku->rak }}">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="tersedia" {{ $buku->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="dipinjam" {{ $buku->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kondisi</label>
                            <select name="kondisi" class="form-control">
                                <option value="bagus" {{ $buku->kondisi == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                <option value="rusak" {{ $buku->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" value="{{ $buku->pengarang }}">
                        </div>
                        <div class="form-group text-left mt-4">
                            <br>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('buku.index') }}" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection