<?php

namespace App\Http\Controllers;

use App\Models\JalurMasuk;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /** Warna segmen komposisi jalur masuk (berulang jika jalurnya lebih banyak). */
    private const PALET = ['#1f56d6', '#f6b21a', '#0d2352', '#5b9bff', '#8da2c9', '#c3cfe6'];

    /** Tinggi maksimum batang grafik angkatan, dalam piksel. */
    private const TINGGI_BAR = 148;

    public function __invoke(Request $request): View
    {
        $sekarang = now('Asia/Jakarta');
        $totalMahasiswa = Mahasiswa::count();
        $totalJalur = JalurMasuk::count();

        // Komposisi per jalur masuk
        $perJalur = JalurMasuk::withCount('mahasiswa')
            ->orderByDesc('mahasiswa_count')
            ->orderBy('nama_jalur')
            ->get()
            ->values()
            ->map(fn ($jalur, $i) => [
                'nama' => $jalur->nama_jalur,
                'total' => $jalur->mahasiswa_count,
                'persen' => $totalMahasiswa > 0 ? $jalur->mahasiswa_count / $totalMahasiswa * 100 : 0,
                'warna' => self::PALET[$i % count(self::PALET)],
            ]);

        // Jumlah mahasiswa per angkatan
        $angkatan = Mahasiswa::select('angkatan', DB::raw('COUNT(*) as total'))
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->get();
        $maks = max(1, (int) $angkatan->max('total'));
        $perAngkatan = $angkatan->map(fn ($a) => [
            'angkatan' => $a->angkatan,
            'total' => (int) $a->total,
            'tinggi' => max(6, (int) round($a->total / $maks * self::TINGGI_BAR)),
        ]);

        $terbaru = Mahasiswa::with('jalurMasuk')->latest()->take(5)->get();

        $jam = $sekarang->hour;
        $sapaan = match (true) {
            $jam < 11 => 'Selamat pagi',
            $jam < 15 => 'Selamat siang',
            $jam < 18 => 'Selamat sore',
            default => 'Selamat malam',
        };

        return view('dashboard', [
            'sapaan' => $sapaan,
            'namaDepan' => (string) Str::of($request->user()->name)->before(' '),
            'tanggal' => $sekarang->locale('id')->translatedFormat('l, j F Y'),
            'totalMahasiswa' => $totalMahasiswa,
            'totalJalur' => $totalJalur,
            'totalAngkatan' => $angkatan->count(),
            'angkatanTerbaru' => $angkatan->last()?->angkatan,
            'jalurTerbanyak' => $totalMahasiswa > 0 ? $perJalur->first() : null,
            'perJalur' => $perJalur,
            'perAngkatan' => $perAngkatan,
            'terbaru' => $terbaru,
        ]);
    }
}
