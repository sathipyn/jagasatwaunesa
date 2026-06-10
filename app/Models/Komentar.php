<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';

    protected $fillable = [
        'user_id',
        'kucing_id',
        'isi_komentar',
        'tanggal_komentar',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_komentar' => 'date',
        ];
    }

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kucing()
    {
        return $this->belongsTo(Kucing::class);
    }
}
