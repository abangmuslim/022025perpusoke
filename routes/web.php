<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\Auth\AuthPeminjamController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Halaman dashboard

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::put('/admin/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::put('/admin/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');
    Route::get('/profile', [AdminController::class, 'showProfile'])->name('profile');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/peminjam', [PeminjamController::class, 'index'])->name('peminjam.index');
    Route::get('/peminjam/create', [PeminjamController::class, 'create'])->name('peminjam.create');
    Route::post('/peminjam', [PeminjamController::class, 'store'])->name('peminjam.store');
    Route::get('/peminjam/{id}', [PeminjamController::class, 'show'])->name('peminjam.show');
    Route::get('/peminjam/{id}/edit', [PeminjamController::class, 'edit'])->name('peminjam.edit');
    Route::put('/peminjam/{id}', [PeminjamController::class, 'update'])->name('peminjam.update');
    Route::delete('/peminjam/{id}', [PeminjamController::class, 'destroy'])->name('peminjam.destroy');
    Route::put('/peminjam/{id}/approve', [PeminjamController::class, 'approve'])->name('peminjam.approve');
    Route::put('/peminjam/{id}/reject', [PeminjamController::class, 'reject'])->name('peminjam.reject');
});



Route::get('/peminjam/login', [AuthPeminjamController::class, 'showLoginForm'])->name('peminjam.login');
Route::post('/peminjam/login', [AuthPeminjamController::class, 'login'])->name('peminjam.login.submit');
Route::get('/peminjam/register', [AuthPeminjamController::class, 'showRegisterForm'])->name('peminjam.register');
Route::post('/peminjam/register', [AuthPeminjamController::class, 'register'])->name('peminjam.register.submit');
Route::post('/peminjam/logout', [AuthPeminjamController::class, 'logout'])->name('peminjam.logout');
