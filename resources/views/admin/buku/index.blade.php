@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Buku</h2>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('buku.create') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-150">
                Tambah Buku
            </a>
        @endif
    </div>

    {{-- Alert sukses --}}
    @if (session('success'))
    <div class="mb-4 flex items-center justify-between p-4 rounded-lg border border-green-500 bg-green-600/90 text-white shadow-md transition-all">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-white text-xl leading-none">&times;</button>
    </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-100">
            <thead class="bg-gray-200 dark:bg-gray-800 uppercase text-xs font-semibold tracking-wide">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Cover</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Penulis</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukus as $index => $buku)
                    <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-3 text-gray-800 dark:text-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">
                            @if($buku->cover)
                                <img src="{{ asset('storage/' . $buku->cover) }}" alt="cover"
                                     class="w-12 h-12 object-cover rounded-md shadow-sm border border-gray-500/40">
                            @else
                                <span class="text-gray-400 italic">No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $buku->judul }}</td>
                        <td class="px-4 py-3">{{ $buku->kategori->nama ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $buku->penulis }}</td>

                        {{-- Kolom Aksi --}}
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                @if(auth()->user()->role === 'admin')
                                    {{-- Tombol untuk admin --}}
                                    <a href="{{ route('buku.edit', $buku->id) }}"
                                       class="px-3 py-1 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow transition duration-150">
                                        Edit
                                    </a>
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-md shadow transition duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    {{-- Tombol Booking Buku untuk Member --}}
                                    <form action="{{ route('peminjaman.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                        <button type="submit"
                                            class="px-3 py-1 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded-md shadow transition duration-150">
                                            Booking Buku
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-300 italic">
                            Belum ada buku yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
