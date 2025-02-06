<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Peminjam;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah data dari setiap model
        $adminCount = Admin::count();
        $peminjamCount = Peminjam::count();
        $bukuCount = Buku::count();
        $peminjamanCount = Peminjaman::count();

        // Kirim data ke view dashboard
        return view('dashboard', compact('adminCount', 'peminjamCount', 'bukuCount', 'peminjamanCount'));
    }
}
