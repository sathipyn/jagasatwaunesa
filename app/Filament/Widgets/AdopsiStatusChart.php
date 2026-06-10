<?php

namespace App\Filament\Widgets;

use App\Models\Adopsi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class AdopsiStatusChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 2,
    ];

    protected ?string $heading = 'Status Adopsi';

    protected ?string $description = 'Komposisi pengajuan adopsi saat ini.';

    protected ?string $maxHeight = '165px';

    protected string $color = 'info';

    protected function getData(): array
    {
        return Cache::remember('filament.dashboard.adopsi-status-chart', now()->addMinutes(2), function (): array {
            return [
                'datasets' => [
                    [
                        'data' => [
                            Adopsi::where('status_adopsi', 'Pending')->count(),
                            Adopsi::where('status_adopsi', 'Diterima')->count(),
                            Adopsi::where('status_adopsi', 'Ditolak')->count(),
                        ],
                        'backgroundColor' => [
                            '#f9a8d4',
                            '#fb7185',
                            '#ef4444',
                        ],
                        'borderWidth' => 0,
                    ],
                ],
                'labels' => ['Pending', 'Diterima', 'Ditolak'],
            ];
        });
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
            'cutout' => '62%',
        ];
    }
}
