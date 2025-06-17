<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen  bg-gradient-to-br from-blue-500 to-purple-500">
<!-- Navigation -->
    <nav class="flex bg-white items-center justify-between px-12 py-4" x-data="{ open: false }">
        <!-- Hamburger (Mobile Only) -->
        <div class="flex items-center gap-2">
            <button @click="open = !open" class="md:hidden text-gray-600 focus:outline-none cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
    
            <a href="{{ route('home') }}" wire:navigate class="ml-2 mr-5 flex items-center space-x-2 lg:ml-0">
                <x-app-logo class="size-8" href="#"></x-app-logo>
            </a>
        </div>

        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('home') }}" wire:navigate class="text-gray-600/80 font-bold hover:text-gray-600 transition-colors">Beranda</a>
            <a href="{{ route('products.index') }}" wire:navigate class="text-gray-600/80 font-bold hover:text-gray-600 transition-colors">Produk</a>
            <a href="{{ route('categories.index') }}" wire:navigate class="text-gray-600/80 font-bold hover:text-gray-600 transition-colors">Kategori</a>
            <p class="text-gray-600/80 font-bold hover:text-gray-600 transition-colors">Komunitas <span class="text-[7px]">Soon</span></p>
            {{-- <p href="{{ route('home') }}" wire:navigate class="text-gray-600/80 font-bold hover:text-gray-600 transition-colors">About <span class="text-[7px]">Soon</span></p> --}}
        </div>

        <!-- Mobile Menu (Dropdown) -->
        <div
            x-show="open"
            @click.away="open = false"
            @keydown.escape.window="open = false"
            @click.outside="open = false"
            x-transition
            class="absolute left-0 w-full bg-white shadow-lg rounded-b-md md:hidden z-50 px-6 py-4 space-y-3 top-15"
        >
            <a href="{{ route('home') }}" wire:navigate class="block text-gray-600/80 font-bold hover:text-blue-500 transition-all">Beranda</a>
            <a href="{{ route('products.index') }}" wire:navigate class="block text-gray-600/80 font-bold hover:text-blue-500 transition-all">Produk</a>
            <a href="{{ route('categories.index') }}" wire:navigate class="block text-gray-600/80 font-bold hover:text-blue-500 transition-all">Kategori</a>
            <p class="block text-gray-600/80 font-bold hover:text-blue-500 transition-all">Komunitas <span class="text-[7px]">Soon</span></p>
            {{-- <a href="{{ route('home') }}" wire:navigate class="block text-gray-600/80 font-bold">About</a> --}}

            @guest
            <div class="pt-3 border-t border-gray-200 space-y-2">
                <a href="{{ route('register') }}" class="block text-purple-500 font-bold hover:text-purple-600 transition">Daftar</a>
                <a href="{{ route('login') }}" class="block bg-gradient-to-br from-blue-500 to-purple-500 text-white text-center font-bold px-4 py-2 rounded-md">Masuk</a>
            </div>
            @endguest

            @auth
            <div class="pt-3 border-t border-gray-200 space-y-2">
                <a href="{{ route('products.create') }}" class="block bg-gradient-to-br from-blue-500 to-purple-500 text-white text-center font-bold px-4 py-2 rounded-md">Tambah</a>
                <a href="{{ route('profile.show', auth()->user()->username) }}" class="block text-gray-600/80 font-bold">Profil</a>
                @can('access dashboard')
                <a href="{{ route('admin.index') }}" class="block text-gray-600/80 font-bold">Admin Dashboard</a>
                @endcan
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-red-500 font-bold">Keluar</button>
                </form>
            </div>
            @endauth
        </div>

        @guest
            <div class="flex items-center space-x-4">
                <button class="text-purple-500 font-bold hover:text-gray-600 transition-colors">
                    <a href="{{ route('register') }}">{{ __('global.register') }}</a>
                </button>
                <button class="bg-gradient-to-br from-blue-500 to-purple-500 hover:bg-purple-700 text-white font-bold px-6 py-2 rounded-md transition-colors">
                    <a href="{{ route('login') }}">{{ __('global.log_in') }}</a>
                </button>
            </div>
        @endguest

        @auth
            @if (Session::has('admin_user_id'))
                <div class="py-2 flex items-center justify-center rounded mr-4">
                    <form id="stop-impersonating" class="flex flex-col items-center gap-3" action="{{ route('impersonate.destroy') }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <flux:button type="submit" size="sm" variant="danger" form="stop-impersonating" class="!w-full !flex !flex-row cursor-pointer">
                            <div class="flex items-center gap-2">
                                <flux:icon.loader-circle class="animate-spin mr-2"/>
                                {{ __('users.stop_impersonating') }}
                            </div>
                        </flux:button>
                    </form>
                </div>
            @endif
        <div class="flex items-center space-x-4">
            <a href="{{ route('products.create') }}" wire:navigate class="bg-gradient-to-br from-blue-500 to-purple-500 hover:bg-purple-700 text-white font-bold px-6 py-2 rounded-md transition-colors">
                Tambah
            </a>

            <!-- Notification Button -->
            {{-- <button class="relative p-2 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">3</span>
            </button> --}}

            <!-- Profile Dropdown with Alpine -->
            <div x-data="{ open: false }" class="relative"> 
                <button @click="open = !open" @keydown.escape.window="open = false"
                        class="flex items-center justify-center w-8 h-8 cursor-pointer rounded-full bg-gray-100 hover:bg-gray-200 transition-colors">
                    {{ auth()->user()->initials() }}
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50"
                    style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ auth()->user()->username }}</p>
                    </div>

                    <div class="py-2">
                        @can('access dashboard')
                            <a href="{{ route('admin.index') }}" wire:navigate class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <i class="fas fa-shield mr-3 text-gray-400"></i> {{ __('global.admin_dashboard') }}
                            </a>
                        @endcan
                        <a href="{{ route('profile.show', auth()->user()->username) }}" wire:navigate class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-user-circle mr-3 text-gray-400"></i> {{ __('global.profile') }}
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            <i class="fas fa-question-circle mr-3 text-gray-400"></i> Help Center
                        </a>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="py-2 border-t border-gray-100">
                        @csrf
                        <button type="submit" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition-colors w-full cursor-pointer">
                            <i class="fas fa-sign-out-alt mr-3 text-red-400"></i>
                            {{ __('global.log_out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endauth
    </nav>

    <main class="flex flex-col">
        <div class="min-h-screen">
            {{ $slot }}
        </div>

    </main>
    @include('partials.footer')







@fluxScripts
</body>
</html>
