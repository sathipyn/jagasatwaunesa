<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Models\LaporanKasus;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Actions\DeleteAction;

class LaporanKasusRelationManager extends RelationManager
{
    protected static string $relationship = 'laporanKasus';
    protected static ?string $title = 'Riwayat Laporan Kasus';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_laporan')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40)
                    ->weight('bold'),

                TextColumn::make('kategori_kasus')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => LaporanKasus::kategoriKasusLabel($state))
                    ->color(fn (?string $state): string => LaporanKasus::kategoriKasusBadgeColor($state)),

                TextColumn::make('lokasi_laporan')
                    ->label('Lokasi')
                    ->limit(25),

                TextColumn::make('tanggal_laporan')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                ImageColumn::make('bukti_pendukung')
                    ->label('Bukti')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => $record->bukti_pendukung[0] ?? null)
                    ->circular()
                    ->size(40),

                ImageColumn::make('foto_penanganan')
                    ->label('Penanganan')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => $record->foto_penanganan[0] ?? null)
                    ->circular()
                    ->size(40),

                SelectColumn::make('status_laporan')
                    ->label('Status')
                    ->options([
                        'Diproses' => 'Diproses',
                        'Selesai'  => 'Selesai',
                    ]),
            ])
            ->defaultSort('tanggal_laporan', 'desc')
            ->recordActions([DeleteAction::make()]);
    }
}
