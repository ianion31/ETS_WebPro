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
    <body class="h-full font-sans text-slate-800 antialiased">
        <div class="grid min-h-screen lg:grid-cols-[minmax(0,5fr)_minmax(0,6fr)]">

            <!-- Panel merek (hanya layar besar) -->
            <aside class="relative hidden overflow-hidden bg-ink p-12 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="relative z-10 flex items-center gap-3">
                    <x-application-logo class="h-9 w-9 fill-current text-gold" />
                    <span class="text-sm font-extrabold tracking-tight">Database Mahasiswa</span>
                </div>

                <div class="relative z-10 max-w-md">
                    <h1 class="text-4xl font-extrabold leading-tight tracking-tight">Data mahasiswa, tertata dan mudah dicari.</h1>
                    <p class="mt-4 text-base leading-relaxed text-slate-300">Kelola data mahasiswa dan jalur masuknya dari satu panel admin.</p>
                </div>

                <x-application-logo class="pointer-events-none absolute -bottom-24 -right-24 h-[28rem] w-[28rem] fill-current text-white/5" />
            </aside>

            <!-- Formulir -->
            <main class="flex flex-col justify-center bg-paper px-6 py-12 sm:px-12">
                <div class="mx-auto w-full max-w-sm">
                    <div class="mb-8 flex items-center gap-3 lg:hidden">
                        <x-application-logo class="h-9 w-9 fill-current text-ink" />
                        <span class="text-sm font-extrabold tracking-tight text-ink">Database Mahasiswa</span>
                    </div>

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
