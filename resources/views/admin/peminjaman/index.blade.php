@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Peminjaman</h2>

    {{-- ✅ Alert sukses --}}
    @if (session('success'))
        <div class="mb-4 flex items-center justify-between p-4 rounded-lg border border-green-500 bg-green-600/90 text-white shadow-md transition-all">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-white text-xl">&times;</button>
        </div>
    @endif

    {{-- ✅ Tabel Data --}}
    <div class="overflow-x-auto rounded-lg border border-gray-700">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-100">
            <thead class="bg-gray-200 dark:bg-gray-800 uppercase text-xs font-semibold tracking-wide">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Buku</th>
                    <th class="px-4 py-3">Tgl Pinjam</th>
                    <th class="px-4 py-3">Tgl Kembali</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Denda</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $i => $pinjam)
                    <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-3">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $pinjam->user->name }}</td>
                        <td class="px-4 py-3">{{ $pinjam->buku->judul }}</td>
                        <td class="px-4 py-3">{{ $pinjam->tanggal_pinjam_formatted }}</td>
                        <td class="px-4 py-3">{{ $pinjam->tanggal_kembali_formatted }}</td>
                        
                        {{-- STATUS --}}
                        <td class="px-4 py-3 capitalize">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                @if($pinjam->status == 'booking') bg-yellow-500 
                                @elseif($pinjam->status == 'dipinjam') bg-blue-600 
                                @elseif($pinjam->status == 'dikembalikan') bg-green-600 
                                @else bg-red-600 @endif text-white">
                                {{ $pinjam->status }}
                            </span>
                        </td>

                        {{-- DENDA --}}
                        <td class="px-4 py-3">
                            @if($pinjam->status == 'dikembalikan')
                                Rp {{ number_format($pinjam->denda, 0, ',', '.') }}
                            @else
                                <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-4 py-3 text-center space-x-2">
                            @if($pinjam->status == 'booking')
                                {{-- Setujui --}}
                                <form action="{{ route('peminjaman.updateStatus', $pinjam->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="dipinjam">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-xs shadow">Setujui</button>
                                </form>

                                {{-- Tolak --}}
                                <form action="{{ route('peminjaman.updateStatus', $pinjam->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="ditolak">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs shadow">Tolak</button>
                                </form>

                            @elseif($pinjam->status == 'dipinjam')
                                {{-- Kembalikan --}}
                                <form action="{{ route('peminjaman.updateStatus', $pinjam->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="dikembalikan">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-xs shadow">Kembalikan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400 italic">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
