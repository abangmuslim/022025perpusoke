<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        ]);

        Peminjam::create([
            'namapeminjam' => $request->namapeminjam,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'pending',
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
        ]);

        $peminjam->update([
            'namapeminjam' => $request->namapeminjam,
            'username' => $request->username,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Data peminjam diperbarui.');
    }

    public function show($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        return view('peminjam.show', compact('peminjam'));
    }

    public function destroy($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->delete();

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil dihapus.');
    }

    public function approve($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->update([
            'status' => 'setujui',
            'setujui' => now(),
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Peminjam disetujui.');
    }

    public function reject($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->update([
            'status' => 'tolak',
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Peminjam ditolak.');
    }
}
