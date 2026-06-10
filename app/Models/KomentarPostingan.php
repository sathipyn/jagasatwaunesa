<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarPostingan extends Model
{
    use HasFactory;

    protected $table = 'komentar_postingan';

    protected $fillable = [
        'user_id',
        'edukasi_id',
        'kegiatan_id',
        'isi_komentar',
        'tanggal_komentar',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_komentar' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function edukasi()
    {
        return $this->belongsTo(Edukasi::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
