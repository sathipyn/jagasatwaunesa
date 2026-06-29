<?php

namespace App\Filament\Pages;

use App\Models\Donasi;
use App\Models\PenggunaanDana;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use UnitEnum;

class LaporanTransparansiDana extends Page
{
    protected static ?string $navigationLabel = 'Laporan Transparansi Dana';
    protected static string|UnitEnum|null $navigationGroup = 'Donasi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentChartBar;
    protected static ?string $slug = 'laporan-transparansi-dana';
    protected static ?string $title = 'Laporan Transparansi Dana';
    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.laporan-transparansi-dana';

    public function getHeading(): string|Htmlable
    {
        return 'Laporan Transparansi Dana';
    }

    public function getSubheading(): ?string
    {
        return 'Ringkasan dana masuk, dana terpakai, dan saldo bersama.';
    }

    public function getTotalMasuk(): float
    {
        return (float) Donasi::sum('jumlah_donasi');
    }

    public function getTotalKeluar(): float
    {
        return (float) PenggunaanDana::sum('jumlah');
    }

    public function getSaldo(): float
    {
        return $this->getTotalMasuk() - $this->getTotalKeluar();
    }

    public function getRincianPenggunaan(): Collection
    {
        return PenggunaanDana::query()
            ->orderByDesc('tanggal')
            ->get();
    }

    public function getRincianPenggunaanPerBulan(): Collection
    {
        return PenggunaanDana::groupByMonth($this->getRincianPenggunaan());
    }

    public function formatRupiah(float|int $amount): string
    {
        return 'Rp' . number_format((float) $amount, 0, ',', '.');
    }
}
