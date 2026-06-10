<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdopsiStatusChart;
use App\Filament\Widgets\LaporanChart;
use App\Filament\Widgets\RecentAdopsiWidget;
use App\Filament\Widgets\RecentLaporanWidget;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::Home;

    protected static ?int $navigationSort = -10;

    protected static string $routePath = '/';

    public function getColumns(): int|array
    {
        return [
            'md' => 2,
            'xl' => 6,
        ];
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            LaporanChart::class,
            AdopsiStatusChart::class,
            RecentLaporanWidget::class,
            RecentAdopsiWidget::class,
        ];
    }
}
