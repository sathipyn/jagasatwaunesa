<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\DeleteAction;

class DonasiRelationManager extends RelationManager
{
    protected static string $relationship = 'donasi';
    protected static ?string $title = 'Riwayat Donasi';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jumlah_donasi')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('tujuan_donasi')
                    ->label('Tujuan')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Pakan' => 'info', 'Steril' => 'success',
                        'Pengobatan' => 'danger', 'Vaksin' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('metode_transfer')
                    ->label('Transfer Ke')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'spay' => 'ShopeePay',
                        'bca' => 'BCA',
                        default => '-',
                    }),

                TextColumn::make('hasil_penggunaan')
                    ->label('Penggunaan')
                    ->limit(30),

                TextColumn::make('tanggal_donasi')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_penggunaan')
                    ->label('Dipakai')
                    ->date('d M Y')
                    ->sortable(),

                ImageColumn::make('bukti_transfer')
                    ->label('Bukti')
                    ->disk('public')
                    ->circular()
                    ->size(40),

                ImageColumn::make('foto_penggunaan')
                    ->label('Bukti Pakai')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => $record->foto_penggunaan[0] ?? null)
                    ->circular()
                    ->size(40),
            ])
            ->defaultSort('tanggal_donasi', 'desc')
            ->recordActions([DeleteAction::make()]);
    }
}
