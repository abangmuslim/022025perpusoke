<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Default 10 baris per halaman

        $buku = Buku::with('kategori')
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%$search%");
            })
            ->paginate($perPage);

        $kategori = Kategori::all();

        return view('buku.index', compact('buku', 'kategori'));
    }


    public function create()
    {
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idkategori' => 'required',
            'nomorseri' => 'required|unique:buku,nomorseri',
            'judul' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'tahun' => 'required|digits:4',
            'status' => 'required',
            'kondisi' => 'required',
            'rak' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $fotoPath = $request->file('foto')->store('buku', 'public');

        Buku::create([
            'idkategori' => $request->idkategori,
            'nomorseri' => $request->nomorseri,
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            'tahun' => $request->tahun,
            'status' => $request->status,
            'kondisi' => $request->kondisi,
            'rak' => $request->rak,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Buku $buku)
    {
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    // public function edit($id)
    // {
    //     $buku = Buku::find($id);
    //     if (!$buku) {
    //         return response()->json(['error' => 'Buku tidak ditemukan'], 404);
    //     }
    //     return response()->json($buku);
    // }


    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'idkategori' => 'required',
            'nomorseri' => 'required|unique:buku,nomorseri,' . $buku->id,
            'judul' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'tahun' => 'required|digits:4',
            'status' => 'required',
            'kondisi' => 'required',
            'rak' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            Storage::delete('public/' . $buku->foto);
            $fotoPath = $request->file('foto')->store('buku', 'public');
            $buku->foto = $fotoPath;
        }

        $buku->update([
            'idkategori' => $request->idkategori,
            'nomorseri' => $request->nomorseri,
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            'tahun' => $request->tahun,
            'status' => $request->status,
            'kondisi' => $request->kondisi,
            'rak' => $request->rak,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    public function destroy(Buku $buku)
    {
        Storage::delete('public/' . $buku->foto);
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
