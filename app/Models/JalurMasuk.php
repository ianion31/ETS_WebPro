<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    protected $table = 'jalur_masuk';
    public $timestamps = false;

    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_jalur');
    }
}
