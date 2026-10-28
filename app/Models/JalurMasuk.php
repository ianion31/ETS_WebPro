<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jalur'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}