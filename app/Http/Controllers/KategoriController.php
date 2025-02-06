<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namakategori' => 'required|string|max:255'
        ]);

        $kategori = Kategori::create(['namakategori' => $request->namakategori]);

        return response()->json(['success' => 'Kategori berhasil ditambahkan', 'kategori' => $kategori]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'namakategori' => 'required|string|max:255'
        ]);

        $kategori->update(['namakategori' => $request->namakategori]);

        return response()->json(['success' => 'Kategori berhasil diperbarui']);
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return response()->json(['success' => 'Kategori berhasil dihapus']);
    }
}
