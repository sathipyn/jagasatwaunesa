<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $fillable = [
        'user_id',
        'jumlah_donasi',
        'deskripsi',
        'tanggal_donasi',
        'tujuan_donasi',
        'metode_transfer',
        'bukti_transfer',
        'hasil_penggunaan',
        'foto_penggunaan',
        'tanggal_penggunaan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_donasi' => 'date',
            'jumlah_donasi' => 'double',
            'tanggal_penggunaan' => 'date',
            'foto_penggunaan' => 'array',
        ];
    }

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
