<?php

namespace App\Filament\Resources\Komentars;

use App\Filament\Resources\Komentars\Pages;
use App\Models\Komentar;
use BackedEnum;
use UnitEnum;

use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class KomentarResource extends Resource
{
    protected static ?string $model = Komentar::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleBottomCenterText;
    protected static ?string $navigationLabel = 'Komentar';
    protected static string|UnitEnum|null $navigationGroup = 'Data Kucing';
    protected static ?string $modelLabel = 'Komentar';
    protected static ?string $pluralModelLabel = 'Komentar';
    protected static ?int $navigationSort = 3;

    // Badge jumlah komentar
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'gray';
    }

    // FORM (hanya untuk view/reference, admin tidak buat komentar)
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Detail Komentar')
                ->columns(2)
                ->components([
                    Select::make('user_id')
                        ->label('User')
                        ->relationship('user', 'nama_lengkap')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('kucing_id')
                        ->label('Kucing')
                        ->relationship('kucing', 'nama_kucing')
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('isi_komentar')
                        ->label('Isi Komentar')
                        ->required()
                        ->maxLength(225)
                        ->columnSpanFull(),

                    DatePicker::make('tanggal_komentar')
                        ->label('Tanggal')
                        ->default(now())
                        ->required(),
                ]),
        ]);
    }

    // TABLE
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

                TextColumn::make('kucing.nama_kucing')
                    ->label('Kucing')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->toggleable(),

                TextColumn::make('isi_komentar')
                    ->label('Komentar')
                    ->limit(40)
                    ->toggleable(),

                TextColumn::make('tanggal_komentar')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->defaultSort('created_at', 'desc')

            ->filters([
                Tables\Filters\SelectFilter::make('kucing_id')
                    ->label('Kucing')
                    ->relationship('kucing', 'nama_kucing'),
            ])

            ->recordActions([
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->emptyStateIcon('heroicon-o-chat-bubble-bottom-center-text')
            ->emptyStateHeading('Belum ada komentar')
            ->emptyStateDescription('Komentar dari user pada data kucing akan muncul di sini.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKomentar::route('/'),
        ];
    }
}
