<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthPeminjamController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.peminjam_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'namapeminjam' => 'required|string|max:255',
            'username' => 'required|string|unique:peminjam',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Peminjam::create([
            'namapeminjam' => $request->namapeminjam,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'pending', // Harus disetujui admin
        ]);

        return redirect()->route('peminjam.login')->with('success', 'Registrasi berhasil! Menunggu persetujuan admin.');
    }

    public function showLoginForm()
    {
        return view('auth.peminjam_login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $peminjam = Peminjam::where('username', $request->username)->first();

        if (!$peminjam || !Hash::check($request->password, $peminjam->password)) {
            return back()->with('loginError', 'Username atau password salah.');
        }

        if ($peminjam->status !== 'setujui') {
            return back()->with('loginError', 'Akun belum disetujui oleh admin.');
        }

        Auth::guard('peminjam')->login($peminjam);

        return redirect()->route('dashboard')->with('success', 'Login berhasil.');
    }

    public function logout()
    {
        Auth::guard('peminjam')->logout();
        return redirect()->route('peminjam.login')->with('success', 'Logout berhasil.');
    }
}
