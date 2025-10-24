<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-700 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-6">
                    {{-- Dashboard --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Link untuk Admin --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                            {{ __('Kelola Buku') }}
                        </x-nav-link>
                        <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">
                            {{ __('Kategori') }}
                        </x-nav-link>
                        <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.*')">
                            {{ __('User') }}
                        </x-nav-link>
                        <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.*')">
                            {{ __('Peminjaman') }}
                        </x-nav-link>
                    @endif

                    {{-- Link untuk Member --}}
                    @if(auth()->user()->role === 'user')
                        <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                            {{ __('Daftar Buku') }}
                        </x-nav-link>
                        <x-nav-link :href="route('peminjaman.riwayat')" :active="request()->routeIs('peminjaman.riwayat')">
                            {{ __('Riwayat') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-400 bg-transparent hover:text-white transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Mobile) -->
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 border-t border-gray-700">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('buku.index')">{{ __('Kelola Buku') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kategori.index')">{{ __('Kategori') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.index')">{{ __('User') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('peminjaman.index')">{{ __('Peminjaman') }}</x-responsive-nav-link>
            @elseif(auth()->user()->role === 'user')
                <x-responsive-nav-link :href="route('buku.index')">{{ __('Daftar Buku') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('peminjaman.riwayat')">{{ __('Riwayat') }}</x-responsive-nav-link>
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
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
