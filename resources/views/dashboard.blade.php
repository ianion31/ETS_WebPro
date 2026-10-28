<x-app-layout>
    <x-slot name="header">
        <h1 class="truncate text-base font-bold text-slate-900">Dashboard</h1>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">

        <!-- Sapaan dan aksi cepat -->
        <section class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm text-slate-500">{{ $tanggal }}</p>
                <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">{{ $sapaan }}, {{ $namaDepan }}.</h2>
                <p class="mt-1 text-slate-600">
                    @if ($totalMahasiswa > 0)
                        {{ $totalMahasiswa }} mahasiswa tercatat dari {{ $totalJalur }} jalur masuk.
                    @else
                        Belum ada data mahasiswa yang tercatat.
                    @endif
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah mahasiswa
                </a>
                <a href="{{ route('jalur-masuk.index') }}" class="btn btn-secondary">Kelola jalur masuk</a>
            </div>
        </section>

        @if ($totalJalur === 0)
            <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl bg-gold-soft px-5 py-4 ring-1 ring-gold/40">
                <p class="text-sm text-slate-800">
                    <span class="font-bold">Langkah pertama:</span>
                    tambahkan minimal satu jalur masuk, karena pilihan itu dibutuhkan saat mengisi data mahasiswa.
                </p>
                <a href="{{ route('jalur-masuk.create') }}" class="btn btn-primary">Tambah jalur masuk</a>
            </div>
        @endif

        <!-- Angka ringkas -->
        <section class="grid overflow-hidden rounded-2xl border border-slate-200 bg-white sm:grid-cols-3">
            <div class="border-b border-slate-200 p-6 sm:border-b-0 sm:border-r">
                <p class="text-sm font-medium text-slate-500">Mahasiswa terdata</p>
                <p class="mt-2 text-4xl font-extrabold tabular-nums text-ink">{{ $totalMahasiswa }}</p>
                <p class="mt-1 text-sm text-slate-500">
                    @if ($totalAngkatan > 0)
                        dari {{ $totalAngkatan }} angkatan
                    @else
                        belum ada data
                    @endif
                </p>
            </div>
            <div class="border-b border-slate-200 p-6 sm:border-b-0 sm:border-r">
                <p class="text-sm font-medium text-slate-500">Angkatan terbaru</p>
                <p class="mt-2 text-4xl font-extrabold tabular-nums text-ink">{{ $angkatanTerbaru ?? '-' }}</p>
                <p class="mt-1 text-sm text-slate-500">angkatan paling baru yang tercatat</p>
            </div>
            <div class="p-6">
                <p class="text-sm font-medium text-slate-500">Jalur masuk</p>
                <p class="mt-2 text-4xl font-extrabold tabular-nums text-ink">{{ $totalJalur }}</p>
                <p class="mt-1 text-sm text-slate-500">
                    @if ($jalurTerbanyak)
                        terbanyak: {{ $jalurTerbanyak['nama'] }} ({{ $jalurTerbanyak['total'] }})
                    @else
                        belum ada yang dominan
                    @endif
                </p>
            </div>
        </section>

        <div class="grid gap-6 lg:grid-cols-5">
            <!-- Grafik per angkatan -->
            <section class="rounded-2xl border border-slate-200 bg-white p-6 lg:col-span-3">
                <h3 class="text-base font-bold text-slate-900">Mahasiswa per angkatan</h3>
                <p class="mt-0.5 text-sm text-slate-500">Jumlah mahasiswa yang tercatat pada tiap angkatan.</p>

                @if ($perAngkatan->isEmpty())
                    <div class="mt-6 grid h-52 place-items-center rounded-xl border border-dashed border-slate-300 text-sm text-slate-500">
                        Grafik muncul setelah ada data mahasiswa.
                    </div>
                @else
                    <div class="mt-6 flex h-56 items-end gap-3 overflow-x-auto">
                        @foreach ($perAngkatan as $i => $a)
                            <div class="flex h-full min-w-[2.5rem] flex-1 flex-col items-center justify-end">
                                <span class="mb-1 text-sm font-bold tabular-nums text-slate-900">{{ $a['total'] }}</span>
                                <div class="bar-grow w-full max-w-[3.5rem] rounded-t-lg bg-brand" style="height: {{ $a['tinggi'] }}px; animation-delay: {{ $i * 60 }}ms"></div>
                                <span class="mt-2 text-xs text-slate-500">{{ $a['angkatan'] }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Komposisi jalur masuk -->
            <section class="rounded-2xl border border-slate-200 bg-white p-6 lg:col-span-2">
                <h3 class="text-base font-bold text-slate-900">Komposisi jalur masuk</h3>
                <p class="mt-0.5 text-sm text-slate-500">Dari mana mahasiswa berasal.</p>

                @if ($perJalur->isEmpty())
                    <div class="mt-6 grid h-52 place-items-center rounded-xl border border-dashed border-slate-300 px-4 text-center text-sm text-slate-500">
                        Belum ada jalur masuk.
                    </div>
                @else
                    <div class="mt-6 flex h-4 overflow-hidden rounded-full bg-slate-100" role="img" aria-label="Komposisi mahasiswa per jalur masuk">
                        @foreach ($perJalur as $j)
                            @if ($j['persen'] > 0)
                                <div class="seg-grow h-full" style="width: {{ $j['persen'] }}%; background: {{ $j['warna'] }}" title="{{ $j['nama'] }}"></div>
                            @endif
                        @endforeach
                    </div>

                    <ul class="mt-5 divide-y divide-slate-100">
                        @foreach ($perJalur as $j)
                            <li class="flex items-center gap-3 py-2.5 text-sm">
                                <span class="h-3 w-3 shrink-0 rounded-full" style="background: {{ $j['warna'] }}"></span>
                                <span class="flex-1 truncate font-medium text-slate-800">{{ $j['nama'] }}</span>
                                <span class="font-bold tabular-nums text-slate-900">{{ $j['total'] }}</span>
                                <span class="w-10 text-right tabular-nums text-slate-500">{{ round($j['persen']) }}%</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </div>

        <!-- Mahasiswa terbaru -->
        <section class="rounded-2xl border border-slate-200 bg-white">
            <div class="flex items-center justify-between gap-3 px-6 py-5">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Mahasiswa terbaru</h3>
                    <p class="mt-0.5 text-sm text-slate-500">Lima data yang terakhir ditambahkan.</p>
                </div>
                <a href="{{ route('mahasiswa.index') }}" class="whitespace-nowrap text-sm font-semibold text-brand hover:text-brand-dark">Lihat semua</a>
            </div>

            @if ($terbaru->isEmpty())
                <div class="border-t border-slate-100 px-6 py-10 text-center text-sm text-slate-500">
                    Belum ada mahasiswa. Data yang kamu tambahkan akan muncul di sini.
                </div>
            @else
                <div class="overflow-x-auto border-t border-slate-100">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-slate-500">
                                <th scope="col" class="px-6 py-3 font-medium">Mahasiswa</th>
                                <th scope="col" class="hidden px-6 py-3 font-medium sm:table-cell">Angkatan</th>
                                <th scope="col" class="hidden px-6 py-3 font-medium md:table-cell">Jalur masuk</th>
                                <th scope="col" class="hidden px-6 py-3 font-medium md:table-cell">Ditambahkan</th>
                                <th scope="col" class="px-6 py-3"><span class="sr-only">Aksi</span></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($terbaru as $m)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-3.5">
                                        <div class="flex items-center gap-3">
                                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-brand-soft text-xs font-bold text-brand">{{ strtoupper(mb_substr($m->nama, 0, 1)) }}</span>
                                            <div class="min-w-0">
                                                <p class="truncate font-semibold text-slate-900">{{ $m->nama }}</p>
                                                <p class="text-xs tabular-nums text-slate-500">{{ $m->nrp }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden px-6 py-3.5 tabular-nums text-slate-700 sm:table-cell">{{ $m->angkatan }}</td>
                                    <td class="hidden px-6 py-3.5 md:table-cell">
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ $m->jalurMasuk->nama_jalur ?? '-' }}</span>
                                    </td>
                                    <td class="hidden px-6 py-3.5 text-slate-500 md:table-cell">{{ $m->created_at->locale('id')->diffForHumans() }}</td>
                                    <td class="px-6 py-3.5 text-right">
                                        <a href="{{ route('mahasiswa.edit', $m->id) }}" class="font-semibold text-brand hover:text-brand-dark">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
