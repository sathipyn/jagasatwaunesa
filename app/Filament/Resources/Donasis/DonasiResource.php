<?php

namespace App\Filament\Resources\Donasis;

use App\Filament\Resources\Donasis\Pages;
use App\Models\Donasi;
use BackedEnum;

use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Banknotes;
    protected static ?string $navigationLabel = 'Data Donasi';
    protected static ?string $modelLabel = 'Donasi';
    protected static ?string $pluralModelLabel = 'Data Donasi';
    protected static ?int $navigationSort = 4;

    // Badge total donasi masuk
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(['default' => 1, 'lg' => 2])
            ->components([
            Section::make('Informasi Donasi')
                ->description('Data pengirim donasi.')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->columnSpan(1)
                ->components([

                    Select::make('user_id')
                        ->label('Donatur')
                        ->relationship('user', 'nama_lengkap')
                        ->searchable()
                        ->preload()
                        ->required(),

                    DatePicker::make('tanggal_donasi')
                        ->label('Tanggal Donasi')
                        ->default(now())
                        ->required(),

                    TextInput::make('jumlah_donasi')
                        ->label('Jumlah Donasi')
                        ->numeric()
                        ->prefix('Rp')
                        ->required()
                        ->placeholder('Contoh: 50000'),

                    Select::make('tujuan_donasi')
                        ->label('Tujuan Donasi')
                        ->options([
                            'Pakan'      => 'Pakan',
                            'Steril'     => 'Sterilisasi',
                            'Pengobatan' => 'Pengobatan',
                            'Vaksin'     => 'Vaksinasi',
                            'Lainnya'    => 'Lainnya',
                        ])
                        ->native(false)
                        ->placeholder('Pilih tujuan donasi'),

                    Select::make('metode_transfer')
                        ->label('Transfer ke')
                        ->options([
                            'bca'   => 'BCA',
                            'spay'  => 'ShopeePay',
                        ])
                        ->native(false)
                        ->required(),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi / Catatan')
                        ->maxLength(50)
                        ->rows(2)
                        ->columnSpanFull(),

                    FileUpload::make('bukti_transfer')
                        ->label('Bukti Transfer')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('donasi')
                        ->maxSize(10240)
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => Str::uuid() . '.' . $file->getClientOriginalExtension()
                        )
                        ->columnSpanFull()
                        ->imagePreviewHeight('300'),
                ]),

            Section::make('Penggunaan Donasi')
                ->description('Isi setelah dana dipakai agar donatur bisa melihat transparansi penggunaan.')
                ->icon('heroicon-o-clipboard-document-check')
                ->columns(2)
                ->columnSpan(1)
                ->components([

                    DatePicker::make('tanggal_penggunaan')
                        ->label('Tanggal Penggunaan')
                        ->native(false),

                    Textarea::make('hasil_penggunaan')
                        ->label('Keterangan Penggunaan')
                        ->placeholder('Contoh: Donasi digunakan untuk membeli pakan dan obat untuk kucing yang baru dievakuasi.')
                        ->rows(4)
                        ->columnSpanFull(),

                    FileUpload::make('foto_penggunaan')
                        ->label('Bukti Penggunaan')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->multiple()
                        ->reorderable()
                        ->directory('donasi-penggunaan')
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
                    ->label('Donatur')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('jumlah_donasi')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('tanggal_donasi')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('tujuan_donasi')
                    ->label('Tujuan')
                    ->badge()
                    ->toggleable()
                    ->color(fn (?string $state): string => match ($state) {
                        'Pakan'      => 'info',
                        'Steril'     => 'success',
                        'Pengobatan' => 'danger',
                        'Vaksin'     => 'warning',
                        default      => 'gray',
                    }),

                TextColumn::make('metode_transfer')
                    ->label('Transfer Ke')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'spay' => 'ShopeePay',
                        'bca' => 'BCA',
                        default => '-',
                    })
                    ->toggleable(),

                TextColumn::make('deskripsi')
                    ->label('Catatan')
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('hasil_penggunaan')
                    ->label('Penggunaan')
                    ->limit(32)
                    ->toggleable(),

                TextColumn::make('tanggal_penggunaan')
                    ->label('Dipakai')
                    ->date('d M Y')
                    ->toggleable(),

                ImageColumn::make('bukti_transfer')
                    ->label('Bukti')
                    ->disk('public')
                    ->circular()
                    ->size(40)
                    ->toggleable(),

                ImageColumn::make('foto_penggunaan')
                    ->label('Bukti Pakai')
                    ->disk('public')
                    ->state(fn ($record) => is_array($record->foto_penggunaan) ? ($record->foto_penggunaan[0] ?? null) : null)
                    ->circular()
                    ->size(40)
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->defaultSort('tanggal_donasi', 'desc')

            ->filters([
                Tables\Filters\SelectFilter::make('tujuan_donasi')
                    ->label('Tujuan')
                    ->options([
                        'Pakan'      => 'Pakan',
                        'Steril'     => 'Sterilisasi',
                        'Pengobatan' => 'Pengobatan',
                        'Vaksin'     => 'Vaksinasi',
                        'Lainnya'    => 'Lainnya',
                    ]),
                Tables\Filters\TernaryFilter::make('tanggal_penggunaan')
                    ->label('Sudah dipakai'),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                ->label('Beri Hasil'),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->emptyStateIcon('heroicon-o-banknotes')
            ->emptyStateHeading('Belum ada donasi')
            ->emptyStateDescription('Data donasi akan muncul setelah ada donatur yang mengirimkan donasi.');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDonasi::route('/'),
            'create' => Pages\CreateDonasi::route('/create'),
            'edit'   => Pages\EditDonasi::route('/{record}/edit'),
        ];
    }
}