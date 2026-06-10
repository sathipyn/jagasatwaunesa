<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKasus extends Model
{
    use HasFactory;

    protected $table = 'laporan_kasus';

    public const KATEGORI_KASUS = [
        'kucing_sakit' => [
            'label' => 'Kucing Sakit',
            'emoji' => '🤒',
            'badge' => 'danger',
        ],
        'kucing_terluka' => [
            'label' => 'Kucing Terluka',
            'emoji' => '🩹',
            'badge' => 'warning',
        ],
        'pembuangan_kucing' => [
            'label' => 'Pembuangan Kucing',
            'emoji' => '📦',
            'badge' => 'gray',
        ],
        'kucing_terlantar' => [
            'label' => 'Kucing Terlantar',
            'emoji' => '😿',
            'badge' => 'primary',
        ],
        'kucing_tertabrak' => [
            'label' => 'Kucing Tertabrak',
            'emoji' => '🚑',
            'badge' => 'danger',
        ],
        'kasus_lainnya' => [
            'label' => 'Kasus Lainnya',
            'emoji' => '⚠️',
            'badge' => 'gray',
        ],
    ];

    protected $fillable = [
        'user_id',
        'kategori_kasus',
        'judul_laporan',
        'deskripsi_kasus',
        'tanggal_laporan',
        'lokasi_laporan',
        'status_laporan',
        'bukti_pendukung',
        'hasil_penanganan',
        'foto_penanganan',
        'tanggal_penanganan',
        
        
    ];

    protected function casts(): array
    {
        return [
            'tanggal_laporan' => 'date',
            'foto_penanganan' => 'array',
            'bukti_pendukung' => 'array',
            'tanggal_penanganan' => 'date',
        ];
    }

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function kategoriKasusOptions(): array
    {
        return collect(self::KATEGORI_KASUS)
            ->mapWithKeys(fn (array $item, string $key) => [$key => $item['label']])
            ->all();
    }

    public static function kategoriKasusCards(): array
    {
        return self::KATEGORI_KASUS;
    }

    public static function kategoriKasusLabel(?string $value): string
    {
        return self::KATEGORI_KASUS[$value]['label'] ?? self::KATEGORI_KASUS['kasus_lainnya']['label'];
    }

    public static function kategoriKasusEmoji(?string $value): string
    {
        return self::KATEGORI_KASUS[$value]['emoji'] ?? self::KATEGORI_KASUS['kasus_lainnya']['emoji'];
    }

    public static function kategoriKasusBadgeColor(?string $value): string
    {
        return self::KATEGORI_KASUS[$value]['badge'] ?? self::KATEGORI_KASUS['kasus_lainnya']['badge'];
    }
}
