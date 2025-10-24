@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Daftar Kategori</h2>
        <a href="{{ route('kategori.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-400">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama Kategori</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $kategori)
                <tr class="border-b dark:border-gray-700">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $kategori->nama }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                           class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-4">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $kategoris->links() }}
    </div>
</div>
@endsection
