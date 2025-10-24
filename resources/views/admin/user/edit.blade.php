@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Edit Pengguna</h2>

    <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white
                       focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        {{-- Email --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white
                       focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        {{-- Password (opsional) --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Password (Opsional)</label>
            <input type="password" name="password"
                placeholder="Kosongkan jika tidak ingin mengubah password"
                class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white
                       focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        {{-- Role --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-800 dark:text-white">Role</label>
            <select name="role" required
                class="w-full border rounded-lg p-2 bg-white text-gray-900 dark:bg-gray-800 dark:text-white
                       focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('user.index') }}"
                class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-150">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-150">Update</button>
        </div>
    </form>
</div>
@endsection
