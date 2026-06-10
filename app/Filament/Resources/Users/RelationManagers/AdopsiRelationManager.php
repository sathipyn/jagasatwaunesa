<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use App\Models\Adopsi;

class AdopsiRelationManager extends RelationManager
{
    protected static string $relationship = 'adopsi';
    protected static ?string $title = 'Riwayat Adopsi';

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->width('50px')
                    ->rowIndex()
                    ->toggleable(),

                TextColumn::make('kucing.nama_kucing')
                    ->label('Kucing')
                    ->searchable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('nama_lengkap')
                    ->label('Adopter')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('no_hp')
                    ->label('No WA')
                    ->toggleable(),

                TextColumn::make('tanggal_pengajuan')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('domisili')
                    ->toggleable(),

                TextColumn::make('penghasilan')
                    ->money('IDR')
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->toggleable(),

                TextColumn::make('pro_dokter_hewan')
                    ->badge()
                    ->toggleable(),

                SelectColumn::make('status_adopsi')
                    ->label('Proses')
                    ->toggleable()
                    ->options([
                        'Pending'  => 'Pending',
                        'Diterima' => 'Diterima',
                        'Ditolak'  => 'Ditolak',
                    ]),
            ])


            ->defaultSort('tanggal_pengajuan', 'desc')
            ->recordActions([
                Action::make('wa')
                    ->label('WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(function (Adopsi $record) {
                        $nama   = $record->nama_lengkap ?? 'Adopter';
                        $kucing = $record->kucing->nama_kucing ?? 'kucing';
                        $hp     = preg_replace('/^0/', '62', $record->no_hp ?? '');
                        $pesan  = urlencode("Halo {$nama}, terkait pengajuan adopsi {$kucing} di JagaSatwa.");
                        return $hp ? "https://wa.me/{$hp}?text={$pesan}" : '#';
                    })
                    ->openUrlInNewTab(),
                DeleteAction::make(),
            ]);
    }
}
