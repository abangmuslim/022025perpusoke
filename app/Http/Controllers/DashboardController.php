<?php

namespace App\Http\Controllers;

use App\Models\Admin; // Pastikan model Admin diimpor
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah admin
        $adminCount = Admin::count();
        
        // Mengirim jumlah admin ke view
        return view('dashboard.index', compact('adminCount'));
    }
}
