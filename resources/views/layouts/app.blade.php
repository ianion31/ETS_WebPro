<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Database Mahasiswa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full bg-paper font-sans text-slate-800 antialiased">
        <div x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false" class="min-h-screen">

            @include('layouts.navigation')

            <div class="lg:pl-64">
                <!-- Top bar -->
                <header class="sticky top-0 z-30 flex h-16 items-center gap-3 border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">
                    <button type="button" @click="sidebarOpen = true" class="-ml-2 rounded-lg p-2 text-slate-600 hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand lg:hidden" aria-label="Buka menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    </button>

                    <div class="min-w-0 flex-1 truncate">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    <!-- Menu pengguna -->
                    <div x-data="{ menu: false }" @click.outside="menu = false" class="relative">
                        <button type="button" @click="menu = ! menu" class="flex items-center gap-2 rounded-full py-1 pl-1 pr-2 hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand sm:pr-3" aria-haspopup="true" :aria-expanded="menu">
                            <span class="grid h-8 w-8 place-items-center rounded-full bg-ink text-xs font-bold text-white">{{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
                            <span class="hidden text-sm font-semibold text-slate-700 sm:block">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </button>

                        <div x-show="menu" x-cloak x-transition.origin.top.right.duration.150ms class="absolute right-0 mt-2 w-60 rounded-xl bg-white p-1.5 shadow-lg ring-1 ring-slate-200">
                            <div class="px-3 py-2">
                                <p class="truncate text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                <p class="truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="my-1 border-t border-slate-100"></div>
                            <a href="{{ route('profile.edit') }}" class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">Profil saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full rounded-lg px-3 py-2 text-left text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
