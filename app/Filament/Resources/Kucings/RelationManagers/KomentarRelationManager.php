<?php

namespace App\Filament\Resources\Kucings\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class KomentarRelationManager extends RelationManager
{
    protected static string $relationship = 'komentar';
    protected static ?string $title = 'Komentar User';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.nama_lengkap')
                    ->label('User')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('isi_komentar')
                    ->label('Komentar'),

                TextColumn::make('tanggal_komentar')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('tanggal_komentar', 'desc')
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
