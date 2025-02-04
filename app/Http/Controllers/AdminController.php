<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('admin.index', compact('admin'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaadmin' => 'required',
            'username' => 'required|unique:admin', // Periksa keunikan username
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'namaadmin' => $request->namaadmin,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'pending',
            'role' => $request->role,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['foto'] = $filename;
        }

        Admin::create($data);

        return redirect()->route('admin.index')->with('success', 'Registrasi berhasil! Menunggu persetujuan admin.');
    }


    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'namaadmin' => 'required',
            'username' => 'required|unique:admin,username,' . $id,
            'role' => 'required|in:admin,petugas', // Validasi role
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'namaadmin' => $request->namaadmin,
            'username' => $request->username,
            'role' => $request->role, // Update role
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['foto'] = $filename;
        }

        $admin->update($data);

        return redirect()->route('admin.index')->with('success', 'Data admin diperbarui.');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.show', compact('admin'));
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->foto) {
            unlink(public_path('uploads/' . $admin->foto));
        }
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }

    public function approve($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            'status' => 'setujui',
            'setujui' => now(),
        ]);

        return redirect()->route('admin.index')->with('success', 'User disetujui.');
    }

    public function reject($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            'status' => 'tolak',
        ]);

        return redirect()->route('admin.index')->with('success', 'User ditolak.');
    }

    public function showProfile()
    {
        // Mendapatkan data admin yang sedang login
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }
}
