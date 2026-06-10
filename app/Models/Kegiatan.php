<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'judul',
        'slug',
        'icon',
        'cover_image',
        'closing_image',
        'lokasi',
        'tanggal_kegiatan',
        'ringkasan',
        'deskripsi',
        'konten_tambahan',
        'is_published',
        'is_featured',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'cover_image' => 'array',
            'closing_image' => 'array',
            'tanggal_kegiatan' => 'date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function komentarPostingan()
    {
        return $this->hasMany(KomentarPostingan::class);
    }
}
