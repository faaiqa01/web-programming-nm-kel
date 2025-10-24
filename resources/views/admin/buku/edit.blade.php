@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Edit Buku</h2>

    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

            {{-- Judul Buku --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Judul Buku</label>
                <input type="text" name="judul"
                       class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       value="{{ old('judul', $buku->judul) }}" required>
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Kategori</label>
                <select name="kategori_id"
                        class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategori->id == $buku->kategori_id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Penulis --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Penulis</label>
                <input type="text" name="penulis"
                       class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       value="{{ old('penulis', $buku->penulis) }}" required>
            </div>

            {{-- Penerbit --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Penerbit</label>
                <input type="text" name="penerbit"
                       class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       value="{{ old('penerbit', $buku->penerbit) }}">
            </div>

            {{-- Tahun Terbit --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Tahun Terbit</label>
                <input type="number" name="tahun"
                       class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       value="{{ old('tahun', $buku->tahun) }}">
            </div>

            {{-- Stok --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Stok</label>
                <input type="number" name="stok"
                       class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       value="{{ old('stok', $buku->stok) }}" min="1">
            </div>

            {{-- Deskripsi --}}
            <div class="col-span-1">
                <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                          class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
            </div>

            {{-- Upload Cover --}}
<div class="col-span-1">
    <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Upload Cover</label>

                @if($buku->cover)
                    <div class="mb-3 flex justify-center">
                        <div class="p-2 bg-gray-800/60 dark:bg-gray-700/60 rounded-xl border border-gray-600 shadow-md hover:shadow-lg transition transform hover:scale-105">
                            <img src="{{ asset('storage/' . $buku->cover) }}"
                                alt="cover"
                                style="max-height: 200px; width: auto; border-radius: 8px; object-fit: cover;">
                        </div>
                    </div>
                @endif

                <input type="file" name="cover"
                    class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah cover.</p>
            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('buku.index') }}"
               class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-150">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-150">Update</button>
        </div>
    </form>
</div>
@endsection
