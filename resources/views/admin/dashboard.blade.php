@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">📊 Dashboard Admin</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    {{-- Total Buku --}}
    <div class="flex items-center justify-between p-6 rounded-2xl bg-blue-700 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-transform duration-300 min-h-[140px]">
        <div>
            <h3 class="text-sm font-semibold uppercase text-white">Total Buku</h3>
            <p class="text-4xl font-extrabold text-white mt-1 drop-shadow">{{ $totalBuku }}</p>
        </div>
        <div class="bg-white/10 rounded-full p-3 text-white text-4xl">
            📘
        </div>
    </div>

    {{-- Total Anggota --}}
    <div class="flex items-center justify-between p-6 rounded-2xl bg-green-600 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-transform duration-300 min-h-[140px]">
        <div>
            <h3 class="text-sm font-semibold uppercase text-white">Anggota</h3>
            <p class="text-4xl font-extrabold text-white mt-1 drop-shadow">{{ $totalUser }}</p>
        </div>
        <div class="bg-white/10 rounded-full p-3 text-white text-4xl">
            👥
        </div>
    </div>

    {{-- Total Peminjaman --}}
    <div class="flex items-center justify-between p-6 rounded-2xl bg-yellow-500 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-transform duration-300 min-h-[140px]">
        <div>
            <h3 class="text-sm font-semibold uppercase text-white">Peminjaman</h3>
            <p class="text-4xl font-extrabold text-white mt-1 drop-shadow">{{ $totalPeminjaman }}</p>
        </div>
        <div class="bg-white/10 rounded-full p-3 text-white text-4xl">
            📚
        </div>
    </div>

    {{-- Sedang Dipinjam --}}
     <div class="flex items-center justify-between p-6 rounded-2xl bg-red-500 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-transform duration-300 min-h-[140px]">
        <div>
            <h3 class="text-sm font-semibold uppercase text-white">Sedang Dipinjam</h3>
            <p class="text-4xl font-extrabold text-white mt-1 drop-shadow">{{ $dipinjam }}</p>
        </div>
        <div class="bg-white/10 rounded-full p-3 text-white text-4xl">
            ⏳
        </div>
    </div>
</div>




    {{-- Tabel Peminjaman Terbaru --}}
    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-300 dark:border-gray-700">
        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">📘 Peminjaman Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border-collapse">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">User</th>
                        <th class="px-4 py-2 text-left">Buku</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestPeminjaman as $p)
                    <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $p->user->name }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $p->buku->judul }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $p->tanggal_pinjam->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold text-white
                                @if($p->status=='dipinjam') bg-blue-500
                                @elseif($p->status=='dikembalikan') bg-green-600
                                @elseif($p->status=='booking') bg-yellow-500 text-gray-900
                                @else bg-red-600 @endif">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada data peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
