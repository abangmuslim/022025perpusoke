<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

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

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin) {
            return back()->withErrors(['loginError' => 'Username tidak ditemukan.']);
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['loginError' => 'Username atau password salah.']);
        }

        // Pastikan status tidak mengandung spasi atau perbedaan case
        $status = strtolower(trim($admin->status));

        if ($status !== 'setujui') {
            Auth::logout();
            return back()->withErrors(['loginError' => "Akun belum disetujui oleh admin. Status: $status"]);
        }

        // Setelah login berhasil, arahkan ke dashboard
        return redirect()->route('dashboard'); // Mengubah ke route dashboard
    }




    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
