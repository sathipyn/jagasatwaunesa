<?php

namespace App\Filament\Widgets;

use App\Models\LaporanKasus;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentLaporanWidget extends TableWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->heading('Laporan Terbaru')
            ->description('Kasus terbaru yang masuk ke sistem.')
            ->query(
                LaporanKasus::query()
                    ->with('user')
                    ->latest()
                    ->limit(6)
            )
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->width('50px')
                    ->toggleable(),
                    
                TextColumn::make('judul_laporan')
                    ->label('Kasus')
                    ->searchable()
                    ->limit(32)
                    ->weight('bold'),

                TextColumn::make('kategori_kasus')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => LaporanKasus::kategoriKasusLabel($state))
                    ->color(fn (?string $state): string => LaporanKasus::kategoriKasusBadgeColor($state)),

                TextColumn::make('user.nama_lengkap')
                    ->label('Pelapor')
                    ->limit(20),

                TextColumn::make('status_laporan')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Diproses' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('tanggal_laporan')
                    ->label('Tanggal')
                    ->date('d M Y'),
            ])
            ->paginated(false);
    }
}
