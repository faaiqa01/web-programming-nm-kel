<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // 📘 Menampilkan daftar peminjaman (admin)
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    // 📗 Booking buku oleh anggota
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

    // 🧭 Update status oleh admin (setujui / tolak / kembalikan)
    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $status = $request->status;

        // Logika stok dan tanggal kembali
        if ($status === 'dipinjam') {
            $peminjaman->buku->decrement('stok');
        } elseif ($status === 'dikembalikan') {
            $peminjaman->buku->increment('stok');
            $peminjaman->tanggal_kembali = now(); // ✅ set tanggal kembali otomatis

            // Hitung denda jika lewat 7 hari
            $batas_hari = 7;
            $selisih = $peminjaman->tanggal_pinjam->diffInDays(now());
            $denda = $selisih > $batas_hari ? ($selisih - $batas_hari) * 1000 : 0;

            $peminjaman->denda = $denda;
        }

        $peminjaman->status = $status;
        $peminjaman->save(); // ✅ simpan semua perubahan

        return back()->with('success', 'Status peminjaman diperbarui!');
    }

    // ❌ Hapus peminjaman
    public function destroy($id)
    {
        Peminjaman::destroy($id);
        return back()->with('success', 'Data peminjaman dihapus.');
    }

    // 👤 Riwayat peminjaman user (anggota)
    public function riwayat()
    {
        $peminjamans = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.riwayat', compact('peminjamans'));
    }

    // 🔁 Proses pengembalian (untuk admin, dgn perhitungan denda)
    public function pengembalian($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $batas_hari = 7; // misalnya 7 hari batas pinjam
        $tanggal_pinjam = $peminjaman->tanggal_pinjam;
        $tanggal_kembali = now();
        $selisih = $tanggal_pinjam->diffInDays($tanggal_kembali);

        $denda = 0;
        if ($selisih > $batas_hari) {
            $denda = ($selisih - $batas_hari) * 1000; // 1000 per hari
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => $tanggal_kembali,
            'denda' => $denda,
        ]);

        $peminjaman->buku->increment('stok');

        return redirect()->back()->with('success', 'Buku telah dikembalikan! Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }
}
