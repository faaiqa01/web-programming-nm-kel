@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
        👤 Edit Profil
    </h2>

    {{-- Alert sukses --}}
    @if (session('status') === 'profile-updated')
        <div class="mb-4 p-4 bg-green-500 text-white rounded-lg shadow-md">
            ✅ Profil berhasil diperbarui.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Nama Lengkap
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Email
            </label>
            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Baru --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Password Baru (Opsional)
            </label>
            <input type="password" id="password" name="password"
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                Batal
            </a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- Hapus Akun --}}
    <div class="mt-10 border-t border-gray-300 dark:border-gray-700 pt-6">
        <h3 class="text-lg font-semibold text-red-600 mb-3">⚠️ Hapus Akun</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            Menghapus akun akan menghapus semua data Anda secara permanen.
        </p>
        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Yakin ingin menghapus akun Anda?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition">
                Hapus Akun
            </button>
        </form>
    </div>
</div>
@endsection
