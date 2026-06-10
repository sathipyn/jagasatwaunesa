<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopsi extends Model
{
    use HasFactory;

    protected $table = 'adopsi';

    protected $fillable = [
        'user_id',
        'kucing_id',
        'tanggal_pengajuan',
        'status_adopsi',
        'nama_lengkap',
        'status',
        'alasan',
        'no_hp',
        'domisili',
        'pro_dokter_hewan',
        'update_kabar',
        'penghasilan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengajuan' => 'date',
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