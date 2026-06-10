<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'divisi',
        'jurusan',
        'angkatan',
        'status_keanggotaan',
        'no_hp',
        'fakultas',
    ];

    public function setNamaLengkapAttribute($value): void
    {
        $this->attributes['nama_lengkap'] = is_string($value) ? trim($value) : $value;
    }
}
