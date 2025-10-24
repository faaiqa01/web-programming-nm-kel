<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-700 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Section -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">📚</span>
                <span class="text-xl font-semibold text-gray-800 dark:text-gray-100">E-Library</span>
            </a>
        </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-6">
                    {{-- Dashboard --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Menu untuk ADMIN --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="url('/admin/kategori')" :active="request()->is('admin/kategori*')">
                            {{ __('Kategori') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/buku')" :active="request()->is('admin/buku*')">
                            {{ __('Kelola Buku') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/user')" :active="request()->is('admin/user*')">
                            {{ __('User') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/peminjaman')" :active="request()->is('admin/peminjaman*')">
                            {{ __('Peminjaman') }}
                        </x-nav-link>
                    @endif

                    {{-- Menu untuk ANGGOTA --}}
                    @if(auth()->user()->role === 'anggota' || auth()->user()->role === 'user')
                        <x-nav-link :href="url('/member/buku')" :active="request()->is('member/buku*')">
                            {{ __('Daftar Buku') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/member/riwayat')" :active="request()->is('member/riwayat*')">
                            {{ __('Riwayat Peminjaman') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
            <!-- Right Section (User Dropdown) -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium 
                            text-gray-800 dark:text-gray-300 
                            bg-transparent hover:text-gray-900 dark:hover:text-white 
                            transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>


            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="url('/admin/kategori')">{{ __('Kategori') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/admin/buku')">{{ __('Kelola Buku') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/admin/user')">{{ __('User') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/admin/peminjaman')">{{ __('Peminjaman') }}</x-responsive-nav-link>
            @elseif(auth()->user()->role === 'anggota' || auth()->user()->role === 'user')
                <x-responsive-nav-link :href="url('/member/buku')">{{ __('Daftar Buku') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="url('/member/riwayat')">{{ __('Riwayat Peminjaman') }}</x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
