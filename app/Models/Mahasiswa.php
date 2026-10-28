<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['nrp', 'nama', 'angkatan', 'jalur_masuk_id'];

    public function jalurMasuk()
    {
        return $this->belongsTo(JalurMasuk::class, 'jalur_masuk_id');
    }
}