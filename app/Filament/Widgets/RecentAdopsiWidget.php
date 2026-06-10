<?php

namespace App\Filament\Widgets;

use App\Models\Adopsi;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentAdopsiWidget extends TableWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->heading('Pengajuan Adopsi Terbaru')
            ->description('Ringkasan adopter dan kucing yang diajukan.')
            ->query(
                Adopsi::query()
                    ->with(['user', 'kucing'])
                    ->latest()
                    ->limit(6)
            )
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->width('50px')
                    ->toggleable(),
                    
                TextColumn::make('nama_lengkap')
                    ->label('Adopter')
                    ->searchable()
                    ->limit(24)
                    ->weight('bold'),

                TextColumn::make('kucing.nama_kucing')
                    ->label('Kucing')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('status_adopsi')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                        'Pending' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('tanggal_pengajuan')
                    ->label('Tanggal')
                    ->date('d M Y'),
            ])
            ->paginated(false);
    }
}
