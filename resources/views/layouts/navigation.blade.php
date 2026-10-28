@php
    // Tambah menu baru cukup dengan menambah satu baris di sini.
    // Format: [label, nama route, pola route aktif, path ikon]
    $menu = [
        'Ringkasan' => [
            ['Dashboard', 'dashboard', 'dashboard', 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z'],
        ],
        'Data' => [
            ['Mahasiswa', 'mahasiswa.index', 'mahasiswa.*', 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5'],
            ['Jalur Masuk', 'jalur-masuk.index', 'jalur-masuk.*', 'M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5'],
        ],
    ];
@endphp

<!-- Latar gelap untuk layar kecil -->
<div x-show="sidebarOpen" x-cloak x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-ink/60 lg:hidden" aria-hidden="true"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-ink transition-transform duration-200 lg:translate-x-0" aria-label="Menu utama">
    <!-- Brand -->
    <div class="flex h-16 items-center gap-3 px-5">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-gold">
            <x-application-logo class="h-8 w-8 fill-current text-gold" />
            <span class="leading-tight">
                <span class="block text-sm font-extrabold tracking-tight text-white">Database Mahasiswa</span>
                <span class="block text-xs text-slate-400">Panel admin</span>
            </span>
        </a>
        <button type="button" @click="sidebarOpen = false" class="-mr-2 ml-auto rounded-lg p-2 text-slate-400 hover:bg-white/10 hover:text-white lg:hidden" aria-label="Tutup menu">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>

    <!-- Menu -->
    <nav class="flex-1 space-y-6 overflow-y-auto px-3 py-5">
        @foreach ($menu as $grup => $items)
            <div>
                <p class="px-3 text-xs font-semibold text-slate-400">{{ $grup }}</p>
                <ul class="mt-2 space-y-1">
                    @foreach ($items as [$label, $rute, $pola, $ikon])
                        @php $aktif = request()->routeIs($pola); @endphp
                        <li>
                            <a href="{{ route($rute) }}"
                               @if ($aktif) aria-current="page" @endif
                               class="relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-gold {{ $aktif ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                                @if ($aktif)
                                    <span class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-gold"></span>
                                @endif
                                <svg class="h-5 w-5 shrink-0 {{ $aktif ? 'text-gold' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $ikon }}" /></svg>
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </nav>
</aside>
