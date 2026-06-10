<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    use HasFactory;

    protected $table = 'edukasi';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'icon',
        'cover_image',
        'closing_image',
        'ringkasan',
        'konten',
        'konten_tambahan',
        'is_published',
        'is_featured',
        'urutan',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'cover_image' => 'array',
            'closing_image' => 'array',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function komentarPostingan()
    {
        return $this->hasMany(KomentarPostingan::class);
    }
}
