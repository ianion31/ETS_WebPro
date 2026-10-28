<?php

namespace Database\Seeders;

use App\Models\JalurMasuk;
use Illuminate\Database\Seeder;

class JalurMasukSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['SNBP', 'SNBT', 'Mandiri', 'Kemitraan'] as $nama) {
            JalurMasuk::firstOrCreate(['nama_jalur' => $nama]);
        }
    }
}
