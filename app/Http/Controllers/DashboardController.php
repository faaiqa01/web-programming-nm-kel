<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Statistik untuk admin
            $totalBuku = Buku::count();
            $totalUser = User::where('role', 'anggota')->count();
            $totalPeminjaman = Peminjaman::count();
            $dipinjam = Peminjaman::where('status', 'dipinjam')->count();
            $dikembalikan = Peminjaman::where('status', 'dikembalikan')->count();
            $booking = Peminjaman::where('status', 'booking')->count();

            $latestPeminjaman = Peminjaman::with(['user', 'buku'])
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalBuku',
                'totalUser',
                'totalPeminjaman',
                'dipinjam',
                'dikembalikan',
                'booking',
                'latestPeminjaman'
            ));
        } else {
            // Statistik untuk anggota
            $riwayat = Peminjaman::with('buku')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $totalBooking = Peminjaman::where('user_id', $user->id)->where('status', 'booking')->count();
            $totalDipinjam = Peminjaman::where('user_id', $user->id)->where('status', 'dipinjam')->count();
            $totalSelesai = Peminjaman::where('user_id', $user->id)->where('status', 'dikembalikan')->count();

            return view('member.dashboard', compact('riwayat', 'totalBooking', 'totalDipinjam', 'totalSelesai'));
        }
    }
}
