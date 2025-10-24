@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Riwayat Peminjaman</h2>

    @if($peminjamans->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">Belum ada riwayat peminjaman.</p>
    @else
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-100">
            <thead class="bg-gray-200 dark:bg-gray-800 uppercase text-xs font-semibold tracking-wide">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Judul Buku</th>
                    <th class="px-4 py-3">Tanggal Pinjam</th>
                    <th class="px-4 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $index => $pinjam)
                    <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium">{{ $pinjam->buku->judul ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $pinjam->tanggal_pinjam->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($pinjam->status == 'booking')
                                <span class="px-2 py-1 text-xs bg-yellow-500 text-white rounded-full">Booking</span>
                            @elseif($pinjam->status == 'dipinjam')
                                <span class="px-2 py-1 text-xs bg-blue-500 text-white rounded-full">Dipinjam</span>
                            @elseif($pinjam->status == 'selesai')
                                <span class="px-2 py-1 text-xs bg-green-600 text-white rounded-full">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
