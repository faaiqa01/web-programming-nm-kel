<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $buku = Buku::find($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'status' => 'booking',
        ]);

        return back()->with('success', 'Booking berhasil! Tunggu konfirmasi admin.');
    }

    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $status = $request->status;

        if ($status == 'dipinjam') {
            $peminjaman->buku->decrement('stok');
        } elseif ($status == 'dikembalikan') {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->update(['status' => $status]);
        return back()->with('success', 'Status peminjaman diperbarui!');
    }

    public function destroy($id)
    {
        Peminjaman::destroy($id);
        return back()->with('success', 'Data peminjaman dihapus.');
    }
}
