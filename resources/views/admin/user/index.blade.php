@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Pengguna</h2>
        <a href="{{ route('user.create') }}" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-150">
           Tambah User
        </a>
    </div>

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
            <thead class="bg-gray-200 dark:bg-gray-800 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $user)
                    <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="px-4 py-3">{{ $i + 1 }}</td>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3 capitalize">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                            {{ $user->role == 'admin' ? 'bg-blue-600 text-white' : 'bg-gray-600 text-white' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('user.edit', $user->id) }}" 
                                   class="px-3 py-1 text-xs font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-md">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1 text-xs font-medium bg-red-600 hover:bg-red-700 text-white rounded-md">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
