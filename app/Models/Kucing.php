<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Komentar;
use App\Models\Adopsi;

class Kucing extends Model
{
    use HasFactory;
    protected $table = 'kucing';

    protected $casts = [
    'foto' => 'array',
    ];

    protected $fillable = [
        'nama_kucing',
        'deskripsi',
        'jenis_kelamin',
        'warna_kucing',
        'steril_kucing',
        'vaksin_kucing',
        'lokasi_kucing',
        'foto',
        'open_adopsi',
    ];

    protected function casts(): array
    {
        return [
            'open_adopsi' => 'boolean',
        ];
    }

    // RELASI
    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function komentars()
    {
        return $this->komentar();
    }

    public function adopsi()
    {
        return $this->hasMany(Adopsi::class);
    }
}
