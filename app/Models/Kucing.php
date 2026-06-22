<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\Komentar;
use App\Models\Adopsi;

class Kucing extends Model
{
    use HasFactory;
    protected $table = 'kucing';

    protected $casts = [
        'foto' => 'array',
        'tampil_di_beranda' => 'boolean',
        'urutan_beranda' => 'integer',
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
        'tampil_di_beranda',
        'urutan_beranda',
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

    protected static function booted(): void
    {
        $flushHomepageCache = function (): void {
            Cache::forget('public.home.kucing.v2');
            Cache::forget('public.home.kucing_count');
        };

        static::saved($flushHomepageCache);
        static::deleted($flushHomepageCache);
        static::restored($flushHomepageCache);
    }
}
