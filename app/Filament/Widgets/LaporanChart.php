<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\LaporanKasus;
use Illuminate\Support\Facades\Cache;

class LaporanChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 4,
    ];

    protected ?string $heading = 'Tren Laporan Kasus';

    protected ?string $description = 'Jumlah laporan masuk per bulan pada tahun ini.';

    protected ?string $maxHeight = '230px';

    protected string $color = 'danger';

    protected function getData(): array
    {
        return Cache::remember('filament.dashboard.laporan-chart', now()->addMinutes(2), function (): array {
            $year = now()->year;
            $diproses = [];
            $selesai = [];

            for ($i = 1; $i <= 12; $i++) {
                $diproses[] = LaporanKasus::whereYear('created_at', $year)
                    ->whereMonth('created_at', $i)
                    ->where('status_laporan', 'Diproses')
                    ->count();

                $selesai[] = LaporanKasus::whereYear('created_at', $year)
                    ->whereMonth('created_at', $i)
                    ->where('status_laporan', 'Selesai')
                    ->count();
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Diproses',
                        'data' => $diproses,
                        'borderColor' => '#f43f5e',
                        'backgroundColor' => 'rgba(244, 63, 94, 0.16)',
                        'fill' => true,
                        'tension' => 0.35,
                    ],
                    [
                        'label' => 'Selesai',
                        'data' => $selesai,
                        'borderColor' => '#fb7185',
                        'backgroundColor' => 'rgba(251, 113, 133, 0.12)',
                        'fill' => true,
                        'tension' => 0.35,
                    ],
                ],
                'labels' => [
                    'Jan','Feb','Mar','Apr','Mei','Jun',
                    'Jul','Agu','Sep','Okt','Nov','Des'
                ],
            ];
        });
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
