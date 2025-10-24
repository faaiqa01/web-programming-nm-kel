<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD utama
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('user', UserController::class); 

    Route::resource('peminjaman', PeminjamanController::class)->except(['create', 'edit']);
    Route::post('peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
    Route::get('/riwayat', [App\Http\Controllers\PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat')->middleware('auth');
    Route::put('/peminjaman/pengembalian/{id}', [PeminjamanController::class, 'pengembalian'])->name('peminjaman.pengembalian');

});

require __DIR__.'/auth.php';
