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
            'role' => 'required|in:admin,peminjam',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses penyimpanan berdasarkan role
        if ($request->role === 'admin') {
            $data = [
                'namaadmin' => $request->nama, // Sesuai dengan database
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status' => 'pending',
                'role' => 'admin',
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
                'namapeminjam' => $request->nama, // Sesuai dengan database
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

        // Cek apakah user adalah Admin
        $admin = Admin::where('username', $request->username)->first();
        if ($admin && Auth::guard('web')->attempt($credentials)) { // Gunakan guard 'web' untuk admin
            if ($admin->status !== 'setujui') {
                Auth::logout();
                return back()->withErrors(['loginError' => "Akun belum disetujui oleh admin."]);
            }
            session(['role' => 'admin']);
            return redirect()->route('dashboard');
        }

        // Cek apakah user adalah Peminjam
        $peminjam = Peminjam::where('username', $request->username)->first();
        if ($peminjam && Auth::guard('peminjam')->attempt($credentials)) { // Gunakan guard 'peminjam'
            if ($peminjam->status !== 'setujui') {
                Auth::logout();
                return back()->withErrors(['loginError' => "Akun peminjam belum disetujui oleh admin."]);
            }
            session(['role' => 'peminjam']);

            if (Route::has('peminjam.index')) {
                return redirect()->route('peminjam.index');
            } else {
                return redirect('/')->with('error', 'Route peminjam.index tidak ditemukan.');
            }
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
