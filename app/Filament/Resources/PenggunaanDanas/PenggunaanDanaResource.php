<?php

namespace App\Filament\Resources\PenggunaanDanas;

use App\Filament\Resources\PenggunaanDanas\Pages;
use App\Models\PenggunaanDana;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use UnitEnum;

class PenggunaanDanaResource extends Resource
{
    protected static ?string $model = PenggunaanDana::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowTrendingDown;
    protected static ?string $navigationLabel = 'Penggunaan Dana';
    protected static string|UnitEnum|null $navigationGroup = 'Donasi';
    protected static ?string $modelLabel = 'Penggunaan Dana';
    protected static ?string $pluralModelLabel = 'Penggunaan Dana';
    protected static ?string $slug = 'penggunaan-dana';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(['default' => 1, 'lg' => 2])
            ->components([
                Section::make('Informasi Penggunaan Dana')
                    ->description('Catat setiap pengeluaran dari saldo donasi bersama.')
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->columnSpanFull()
                    ->components([
                        DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->default(now())
                            ->required(),

                        Select::make('kategori')
                            ->label('Kategori')
                            ->options(PenggunaanDana::kategoriOptions())
                            ->native(false)
                            ->required(),

                        TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->placeholder('Contoh: 140000'),

                        Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('foto_bukti')
                            ->label('Foto Bukti')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('penggunaan-dana')
                            ->maxSize(10240)
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => Str::uuid() . '.' . $file->getClientOriginalExtension()
                            )
                            ->columnSpanFull()
                            ->panelLayout('grid')
                            ->imagePreviewHeight('300')
                            ->loadingIndicatorPosition('center')
                            ->removeUploadedFileButtonPosition('top-right')
                            ->appendFiles(),

                        Toggle::make('tampil_di_publik')
                            ->label('Tampilkan di halaman publik')
                            ->default(true)
                            ->helperText('Aktifkan jika pengeluaran ini boleh tampil di /donasi-publik.')
                            ->columnSpanFull(),
                    ]),
            ]);
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

                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => PenggunaanDana::kategoriLabel($state))
                    ->color(fn (?string $state): string => PenggunaanDana::kategoriBadgeColor($state))
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(40)
                    ->toggleable(),

                ToggleColumn::make('tampil_di_publik')
                    ->label('Publik')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options(PenggunaanDana::kategoriOptions()),
                Tables\Filters\TernaryFilter::make('tampil_di_publik')
                    ->label('Ditampilkan di publik'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateIcon('heroicon-o-currency-dollar')
            ->emptyStateHeading('Belum ada data penggunaan dana')
            ->emptyStateDescription('Tambah pengeluaran untuk mulai mencatat transparansi dana.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenggunaanDana::route('/'),
            'create' => Pages\CreatePenggunaanDana::route('/create'),
            'edit' => Pages\EditPenggunaanDana::route('/{record}/edit'),
        ];
    }
}
