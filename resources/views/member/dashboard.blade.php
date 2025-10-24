@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Dashboard Anggota</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="p-4 bg-yellow-500 text-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Booking</h3>
            <p class="text-2xl font-bold">{{ $totalBooking }}</p>
        </div>
        <div class="p-4 bg-blue-600 text-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Dipinjam</h3>
            <p class="text-2xl font-bold">{{ $totalDipinjam }}</p>
        </div>
        <div class="p-4 bg-green-600 text-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Dikembalikan</h3>
            <p class="text-2xl font-bold">{{ $totalSelesai }}</p>
        </div>
    </div>

    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">📚 Riwayat Terbaru</h3>
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                <tr>
                    <th class="px-3 py-2">Judul Buku</th>
                    <th class="px-3 py-2">Tanggal Pinjam</th>
                    <th class="px-3 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $r)
                <tr class="border-b border-gray-300 dark:border-gray-600">
                    <td class="px-3 py-2">{{ $r->buku->judul }}</td>
                    <td class="px-3 py-2">{{ $r->tanggal_pinjam->format('d M Y') }}</td>
                    <td class="px-3 py-2 capitalize">
                        <span class="px-2 py-1 rounded-full text-xs text-white 
                            @if($r->status=='booking') bg-yellow-500 
                            @elseif($r->status=='dipinjam') bg-blue-500
                            @elseif($r->status=='dikembalikan') bg-green-500
                            @else bg-red-500 @endif">
                            {{ $r->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-3 text-gray-500">Belum ada riwayat peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
