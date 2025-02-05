<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamController;

// Redirect ke login jika mengakses root
Route::get('/', function () {
    return redirect()->route('login');
});

// Route login dan register untuk Admin & Peminjam (Menggunakan 1 AuthController)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

// Middleware Auth untuk halaman Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Group untuk Admin
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/{id}', [AdminController::class, 'show'])->name('admin.show');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::put('/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
        Route::put('/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');
        Route::get('/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
        
    });

    // Group untuk Peminjam
    Route::prefix('peminjam')->group(function () {
        Route::get('/', [PeminjamController::class, 'index'])->name('peminjam.index');
        Route::get('/create', [PeminjamController::class, 'create'])->name('peminjam.create');
        Route::post('/', [PeminjamController::class, 'store'])->name('peminjam.store');
        Route::get('/{id}', [PeminjamController::class, 'show'])->name('peminjam.show');
        Route::get('/{id}/edit', [PeminjamController::class, 'edit'])->name('peminjam.edit');
        Route::put('/{id}', [PeminjamController::class, 'update'])->name('peminjam.update');
        Route::delete('/{id}', [PeminjamController::class, 'destroy'])->name('peminjam.destroy');
        Route::put('/{id}/approve', [PeminjamController::class, 'approve'])->name('peminjam.approve');
        Route::put('/{id}/reject', [PeminjamController::class, 'reject'])->name('peminjam.reject');
    });
});
