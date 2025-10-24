<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashboardController;


// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// // Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Semua route yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('buku', BukuController::class);
        Route::resource('user', UserController::class);
        Route::resource('peminjaman', PeminjamanController::class)->except(['create', 'edit']);

        Route::post('peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus'])
            ->name('peminjaman.updateStatus');
        Route::put('peminjaman/pengembalian/{id}', [PeminjamanController::class, 'pengembalian'])
            ->name('peminjaman.pengembalian');
    });

    /*
    |--------------------------------------------------------------------------
    | ANGGOTA ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:anggota')->prefix('member')->group(function () {
        Route::get('/buku', [BukuController::class, 'index'])->name('member.buku.index');
        Route::post('/buku/booking', [PeminjamanController::class, 'store'])->name('member.buku.booking');
        Route::get('/riwayat', [PeminjamanController::class, 'riwayat'])->name('member.peminjaman.riwayat');
    });
});

require __DIR__ . '/auth.php';
