<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'E-Library') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">

    {{-- ✅ Navbar Utama --}}
    @include('layouts.navigation')

    {{-- ✅ Konten Halaman --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    {{-- ✅ Script tambahan --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.0/dist/flowbite.min.js"></script>
</body>
</html>
