<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjam = Peminjam::all();
        return view('peminjam.index', compact('peminjam'));
    }

    public function create()
    {
        return view('peminjam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namapeminjam' => 'required',
            'username' => 'required|unique:peminjam',
            'password' => 'required|min:6',
            'keterangan' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('fotos', 'public') : null;

        Peminjam::create([
            'namapeminjam' => $request->namapeminjam,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'pending',
            'keterangan' => $request->keterangan,
            'alamat' => $request->alamat,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Registrasi berhasil! Menunggu persetujuan admin.');
    }

    public function edit($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        return view('peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, $id)
    {
        $peminjam = Peminjam::findOrFail($id);

        $request->validate([
            'namapeminjam' => 'required',
            'username' => 'required|unique:peminjam,username,' . $id,
            'keterangan' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($peminjam->foto) {
                Storage::disk('public')->delete($peminjam->foto);
            }
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        } else {
            $fotoPath = $peminjam->foto;
        }

        $peminjam->update([
            'namapeminjam' => $request->namapeminjam,
            'username' => $request->username,
            'keterangan' => $request->keterangan,
            'alamat' => $request->alamat,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Data peminjam diperbarui.');
    }

    public function show($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        return view('peminjam.show', compact('peminjam'));
    }


    public function approve($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->update([
            'status' => 'setujui',
            'setujui' => now()
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Peminjam telah disetujui.');
    }

    public function reject($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->update([
            'status' => 'tolak'
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Peminjam telah ditolak.');
    }

    public function destroy($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        if ($peminjam->foto) {
            Storage::disk('public')->delete($peminjam->foto);
        }
        $peminjam->delete();

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil dihapus.');
    }
}
