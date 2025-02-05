<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Peminjam;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:admin,username|unique:peminjam,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,peminjam',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan berdasarkan role
        if ($request->role === 'admin' || $request->role === 'petugas') {
            $data = [
                'namaadmin' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status' => 'pending', // Menunggu persetujuan admin
                'role' => $request->role, // Bisa admin atau petugas
            ];

            // Simpan foto jika ada
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $data['foto'] = $filename;
            }

            Admin::create($data);
        } else {
            Peminjam::create([
                'namapeminjam' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status' => 'pending',
            ]);
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Menunggu persetujuan admin.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah user adalah Admin atau Petugas
        $adminOrPetugas = Admin::where('username', $request->username)->first();
        if ($adminOrPetugas && Auth::guard('web')->attempt($credentials)) {
            if ($adminOrPetugas->status !== 'setujui') {
                Auth::logout();
                return back()->withErrors(['loginError' => "Akun belum disetujui oleh admin."]);
            }

            session(['role' => $adminOrPetugas->role]);

            // Admin & Petugas diarahkan ke dashboard yang sama
            if ($adminOrPetugas->role === 'admin' || $adminOrPetugas->role === 'petugas') {
                return redirect()->route('dashboard');
            }
        }

        // Cek apakah user adalah Peminjam
        $peminjam = Peminjam::where('username', $request->username)->first();
        if ($peminjam && Auth::guard('peminjam')->attempt($credentials)) {
            if ($peminjam->status !== 'setujui') {
                Auth::logout();
                return back()->withErrors(['loginError' => "Akun peminjam belum disetujui oleh admin."]);
            }
            session(['role' => 'peminjam']);
            return redirect()->route('peminjam.index');
        }

        return back()->withErrors(['loginError' => 'Username atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
