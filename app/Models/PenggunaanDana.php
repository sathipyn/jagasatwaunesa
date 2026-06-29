<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PenggunaanDana extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_dana';

    public const KATEGORI = [
        'Pakan' => 'Pakan',
        'Pengobatan' => 'Pengobatan',
        'Sterilisasi' => 'Sterilisasi',
        'Vaksin' => 'Vaksin',
        'Lainnya' => 'Lainnya',
    ];

    protected $fillable = [
        'tanggal',
        'kategori',
        'jumlah',
        'keterangan',
        'foto_bukti',
        'tampil_di_publik',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah' => 'double',
            'foto_bukti' => 'array',
            'tampil_di_publik' => 'boolean',
        ];
    }

    public static function kategoriOptions(): array
    {
        return self::KATEGORI;
    }

    public static function kategoriLabel(?string $kategori): string
    {
        return self::KATEGORI[$kategori] ?? ($kategori ?: '-');
    }

    public static function kategoriBadgeColor(?string $kategori): string
    {
        return match ($kategori) {
            'Pakan' => 'success',
            'Pengobatan' => 'danger',
            'Sterilisasi' => 'warning',
            'Vaksin' => 'info',
            default => 'gray',
        };
    }

    public static function formatPeriodeBulan(string $periode): string
    {
        [$tahun, $bulan] = explode('-', $periode);

        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return ($namaBulan[$bulan] ?? $bulan) . ' ' . $tahun;
    }

    public static function groupByMonth(Collection $items): Collection
    {
        return $items
            ->groupBy(fn (self $pengeluaran): string => $pengeluaran->tanggal?->format('Y-m') ?? '0000-00')
            ->sortKeysDesc()
            ->map(function (Collection $items, string $periode): array {
                return [
                    'periode' => $periode,
                    'label' => $periode === '0000-00'
                        ? 'Tanpa Tanggal'
                        : self::formatPeriodeBulan($periode),
                    'total' => (float) $items->sum('jumlah'),
                    'count' => $items->count(),
                    'items' => $items->values(),
                ];
            })
            ->values();
    }

    public function fotoUtama(): ?string
    {
        return is_array($this->foto_bukti) ? ($this->foto_bukti[0] ?? null) : null;
    }

    public function scopeDitampilkanDiPublik($query)
    {
        return $query->where('tampil_di_publik', true);
    }
}
