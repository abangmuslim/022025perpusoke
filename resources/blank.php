<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Kategori</label>
        <select name="idkategori" class="form-control">
            @foreach($kategori as $item)
            <option value="{{ $item->id }}">{{ $item->namakategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="nomorseri">Nomor Seri</label>
        <input type="text" name="nomorseri" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="penerbit">Penerbit</label>
        <input type="text" name="penerbit" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="pengarang">Pengarang</label>
        <input type="text" name="pengarang" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="tahun">Tahun</label>
        <input type="number" name="tahun" class="form-control" min="1900" max="{{ date('Y') }}" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control" required>
            <option value="tersedia">Tersedia</option>
            <option value="dipinjam">Dipinjam</option>
        </select>
    </div>

    <div class="form-group">
        <label for="kondisi">Kondisi</label>
        <select name="kondisi" class="form-control" required>
            <option value="bagus">Bagus</option>
            <option value="rusak">Rusak</option>
        </select>
    </div>

    <div class="form-group">
        <label for="rak">Rak</label>
        <input type="text" name="rak" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="foto">Foto</label>
        <input type="file" name="foto" class="form-control" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <button type="reset" class="btn btn-warning">Reset</button>
</form>