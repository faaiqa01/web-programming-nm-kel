@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Peminjaman</h2>

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

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-100">
            <thead class="bg-gray-200 dark:bg-gray-800 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Buku</th>
                    <th class="px-4 py-3">Tgl Pinjam</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $i => $pinjam)
                    <tr class="border-b border-gray-300 dark:border-gray-700">
                        <td class="px-4 py-3">{{ $i + 1 }}</td>
                        <td class="px-4 py-3">{{ $pinjam->user->name }}</td>
                        <td class="px-4 py-3">{{ $pinjam->buku->judul }}</td>
                        <td class="px-4 py-3">{{ $pinjam->tanggal_pinjam }}</td>
                        <td class="px-4 py-3 capitalize">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                @if($pinjam->status == 'booking') bg-yellow-500 
                                @elseif($pinjam->status == 'dipinjam') bg-blue-600 
                                @elseif($pinjam->status == 'dikembalikan') bg-green-600 
                                @else bg-red-600 @endif text-white">
                                {{ $pinjam->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center space-x-2">
                            @if($pinjam->status == 'booking')
                                <form action="{{ route('peminjaman.updateStatus', $pinjam->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="dipinjam">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-xs">Setujui</button>
                                </form>
                                <form action="{{ route('peminjaman.updateStatus', $pinjam->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="ditolak">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs">Tolak</button>
                                </form>
                            @elseif($pinjam->status == 'dipinjam')
                                <form action="{{ route('peminjaman.updateStatus', $pinjam->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="dikembalikan">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-xs">Kembalikan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
