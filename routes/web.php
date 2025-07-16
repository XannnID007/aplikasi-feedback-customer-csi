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
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Cabang Management
    Route::resource('cabang', CabangController::class);

    // Umpan Balik Management
    Route::resource('umpan-balik', AdminUmpanBalikController::class);

    // Laporan CSI
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    // Kategori Penilaian Management
    Route::resource('kategori', KategoriController::class);

    // Pertanyaan Management
    Route::resource('pertanyaan', PertanyaanController::class);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes (provided by Breeze)
require __DIR__ . '/auth.php';
