<?php

namespace App\Filament\Widgets;

use App\Models\Adopsi;
use App\Models\Donasi;
use App\Models\Kucing;
use App\Models\LaporanKasus;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return Cache::remember('filament.dashboard.stats-overview', now()->addMinutes(2), function (): array {
            $laporanTrend = $this->dailyTrend(LaporanKasus::query());
            $adopsiTrend = $this->dailyTrend(Adopsi::query());
            $donasiTrend = $this->dailyTrend(Donasi::query(), 'jumlah_donasi');

            return [
                Stat::make('Total Laporan', number_format(LaporanKasus::count()))
                    ->description(LaporanKasus::where('status_laporan', 'Diproses')->count() . ' perlu ditangani')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->chart($laporanTrend)
                    ->chartColor('danger')
                    ->color('danger')
                    ->icon('heroicon-o-megaphone'),

                Stat::make('Kasus Selesai', number_format(LaporanKasus::where('status_laporan', 'Selesai')->count()))
                    ->description('Laporan berhasil ditutup')
                    ->descriptionIcon('heroicon-m-check-circle')
                    ->chart($this->dailyTrend(LaporanKasus::where('status_laporan', 'Selesai')))
                    ->chartColor('success')
                    ->color('success')
                    ->icon('heroicon-o-shield-check'),

                Stat::make('Pengajuan Adopsi', number_format(Adopsi::count()))
                    ->description(Adopsi::where('status_adopsi', 'Pending')->count() . ' masih pending')
                    ->descriptionIcon('heroicon-m-heart')
                    ->chart($adopsiTrend)
                    ->chartColor('info')
                    ->color('info')
                    ->icon('heroicon-o-heart'),

                Stat::make('Total Donasi', 'Rp ' . number_format((float) Donasi::sum('jumlah_donasi'), 0, ',', '.'))
                    ->description(number_format(Donasi::count()) . ' transaksi donasi')
                    ->descriptionIcon('heroicon-m-banknotes')
                    ->chart($donasiTrend)
                    ->chartColor('warning')
                    ->color('warning')
                    ->icon('heroicon-o-banknotes'),

                Stat::make('Kucing Terdata', number_format(Kucing::count()))
                    ->description(Kucing::where('open_adopsi', true)->count() . ' open adopsi')
                    ->descriptionIcon('heroicon-m-sparkles')
                    ->chart($this->dailyTrend(Kucing::query()))
                    ->chartColor('primary')
                    ->color('primary')
                    ->icon('heroicon-o-sparkles'),

                Stat::make('User Terdaftar', number_format(User::count()))
                    ->description('Akun aktif di JagaSatwa')
                    ->descriptionIcon('heroicon-m-users')
                    ->chart($this->dailyTrend(User::query()))
                    ->chartColor('gray')
                    ->color('gray')
                    ->icon('heroicon-o-users'),
            ];
        });
    }

    private function dailyTrend($query, ?string $sumColumn = null): array
    {
        return collect(range(6, 0))
            ->map(function (int $daysAgo) use ($query, $sumColumn): float {
                $date = now()->subDays($daysAgo)->toDateString();
                $dayQuery = (clone $query)->whereDate('created_at', $date);

                return $sumColumn
                    ? (float) $dayQuery->sum($sumColumn)
                    : (float) $dayQuery->count();
            })
            ->all();
    }
}
