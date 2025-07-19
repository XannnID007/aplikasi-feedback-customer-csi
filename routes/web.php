<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UmpanBalikController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UmpanBalikController as AdminUmpanBalikController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PertanyaanController;
use App\Http\Controllers\Admin\CabangController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/umpan-balik', [HomeController::class, 'feedback'])->name('feedback.form');
Route::post('/umpan-balik', [UmpanBalikController::class, 'store'])->name('feedback.store');
Route::get('/terima-kasih', [UmpanBalikController::class, 'sukses'])->name('feedback.sukses');

// Redirect /dashboard to /admin/dashboard (for Laravel Breeze compatibility)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
});

// Admin Routes - Protected by Auth
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard - Available for all authenticated users (admin & super_admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Super Admin Routes
    Route::middleware('super.admin')->group(function () {
        // Cabang Management - Only Super Admin
        Route::resource('cabang', CabangController::class);

        // User Management - Only Super Admin
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });

    // Admin Routes (available for both admin and super_admin)
    Route::middleware('admin.access')->group(function () {
        // Umpan Balik Management
        Route::resource('umpan-balik', AdminUmpanBalikController::class);

        // Laporan CSI
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
        Route::get('/laporan/export-perbandingan', [LaporanController::class, 'exportPerbandingan'])->name('laporan.export-perbandingan');

        // Kategori Penilaian Management
        Route::resource('kategori', KategoriController::class);

        // Pertanyaan Management
        Route::resource('pertanyaan', PertanyaanController::class);
    });

    // Profile Management - Available for all authenticated users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes (provided by Breeze)
require __DIR__ . '/auth.php';
