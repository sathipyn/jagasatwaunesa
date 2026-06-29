<?php

namespace App\Filament\Resources\KomentarPostingans;

use App\Filament\Resources\KomentarPostingans\Pages;
use App\Models\KomentarPostingan;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KomentarPostinganResource extends Resource
{
    protected static ?string $model = KomentarPostingan::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;
    protected static ?string $navigationLabel = 'Komentar Postingan';
    protected static string|UnitEnum|null $navigationGroup = 'Informasi & Kegiatan';
    protected static ?string $modelLabel = 'Komentar Postingan';
    protected static ?string $pluralModelLabel = 'Komentar Postingan';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'gray';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->width('50px')
                    ->toggleable(),

                TextColumn::make('user.nama_lengkap')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('jenis_postingan')
                    ->label('Sumber')
                    ->badge()
                    ->color(fn (KomentarPostingan $record): string => $record->edukasi_id ? 'info' : 'warning')
                    ->state(fn (KomentarPostingan $record): string => $record->edukasi_id ? 'Insight Edukasi' : 'Info Komunitas'),

                TextColumn::make('judul_postingan')
                    ->label('Judul')
                    ->searchable(query: function ($query, string $search) {
                        $query
                            ->whereHas('edukasi', fn ($edukasiQuery) => $edukasiQuery->where('judul', 'like', "%{$search}%"))
                            ->orWhereHas('kegiatan', fn ($kegiatanQuery) => $kegiatanQuery->where('judul', 'like', "%{$search}%"));
                    })
                    ->state(fn (KomentarPostingan $record): string => $record->edukasi?->judul ?? $record->kegiatan?->judul ?? '-')
                    ->limit(45)
                    ->wrap(),

                TextColumn::make('isi_komentar')
                    ->label('Komentar')
                    ->limit(60)
                    ->wrap(),

                TextColumn::make('tanggal_komentar')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')
                    ->label('Sumber')
                    ->options([
                        'edukasi' => 'Insight Edukasi',
                        'kegiatan' => 'Info Komunitas',
                    ])
                    ->query(function ($query, array $data) {
                        return match ($data['value'] ?? null) {
                            'edukasi' => $query->whereNotNull('edukasi_id'),
                            'kegiatan' => $query->whereNotNull('kegiatan_id'),
                            default => $query,
                        };
                    }),
            ])
            ->modifyQueryUsing(fn ($query) => $query->with(['user', 'edukasi', 'kegiatan']))
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right')
            ->emptyStateHeading('Belum ada komentar postingan')
            ->emptyStateDescription('Komentar user dari insight edukasi dan info komunitas akan muncul di sini.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKomentarPostingans::route('/'),
        ];
    }
}
