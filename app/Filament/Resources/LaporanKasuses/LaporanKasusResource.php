<?php

namespace App\Filament\Resources\LaporanKasuses;

use App\Filament\Resources\LaporanKasuses\Pages;
use App\Models\LaporanKasus;
use BackedEnum;
use UnitEnum;

use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class LaporanKasusResource extends Resource
{
    protected static ?string $model = LaporanKasus::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ExclamationTriangle;
    protected static ?string $navigationLabel = 'Laporan Kasus';
    protected static string|UnitEnum|null $navigationGroup = 'Laporan Kasus';
    protected static ?string $modelLabel = 'Laporan Kasus';
    protected static ?string $pluralModelLabel = 'Laporan Kasus';
    protected static ?string $slug = 'laporan-kasus';
    protected static ?int $navigationSort = 1;

    // Badge jumlah laporan yg masih Diproses
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status_laporan', 'Diproses')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informasi Pelapor dan Detail Kasus')
                ->description('Data pelapor dan kasus laporan ')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->components([

                    Select::make('user_id')
                        ->label('Pelapor')
                        ->relationship('user', 'nama_lengkap')
                        ->searchable()
                        ->preload()
                        ->required(),

                    DatePicker::make('tanggal_laporan')
                        ->label('Tanggal Laporan')
                        ->default(now())
                        ->required(),

                    Select::make('kategori_kasus')
                        ->label('Kategori Kasus')
                        ->options(LaporanKasus::kategoriKasusOptions())
                        ->default('kasus_lainnya')
                        ->searchable()
                        ->native(false)
                        ->required(),

                    TextInput::make('judul_laporan')
                        ->label('Judul Laporan')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->placeholder('Contoh: Kucing sakit di area Foodcourt'),

                    Textarea::make('deskripsi_kasus')
                        ->label('Deskripsi Kasus')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull()
                        ->placeholder('Jelaskan detail kasus yang ditemukan...'),

                    TextInput::make('lokasi_laporan')
                        ->label('Lokasi Kejadian')
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->placeholder('Contoh: Depan Gedung A1 FISIPOL'),

                    FileUpload::make('bukti_pendukung')
                        ->label('Foto Bukti Pendukung')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->multiple()
                        ->reorderable()
                        ->directory('laporan-kasus')
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

            Section::make('Hasil Penanganan Kasus')
                ->description('Data penanganan kasus oleh tim Rescue dan Treatment')
                ->icon('heroicon-o-document-text')
                ->columns(2)
                ->components([
                    Select::make('status_laporan')
                        ->label('Status Laporan')
                        ->options([
                            'Diproses' => 'Diproses',
                            'Selesai'  => 'Selesai',
                        ])
                        ->default('Diproses')
                        ->native(false)
                        ->required(),

                    Toggle::make('tampil_di_publik')
                        ->label('Tampilkan di halaman publik')
                        ->default(false)
                        ->helperText('Aktifkan jika laporan ini boleh dijadikan contoh di halaman publik untuk pengunjung umum.')
                        ->columnSpanFull(),
                        
                    DatePicker::make('tanggal_penanganan')
                        ->label('Tanggal Penanganan')
                        ->native(false),

                    Textarea::make('hasil_penanganan')
                        ->label('Hasil Penanganan')
                        ->rows(4)
                        ->columnSpanFull(),

                    FileUpload::make('foto_penanganan')
                        ->label('Foto Penanganan')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->multiple()
                        ->reorderable()
                        ->directory('laporan-penanganan')
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
                    ->label('Pelapor')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                ImageColumn::make('bukti_pendukung')
                    ->label('Bukti')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => $record->bukti_pendukung[0] ?? null)
                    ->circular()
                    ->size(40)
                    ->toggleable(),

                TextColumn::make('judul_laporan')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40)
                    ->toggleable(),

                TextColumn::make('kategori_kasus')
                    ->label('Kategori')
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => LaporanKasus::kategoriKasusLabel($state))
                    ->color(fn (?string $state): string => LaporanKasus::kategoriKasusBadgeColor($state))
                    ->toggleable(),

                TextColumn::make('tanggal_laporan')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('lokasi_laporan')
                    ->label('Lokasi')
                    ->limit(30)
                    ->toggleable(),


                SelectColumn::make('status_laporan')
                    ->label('Status')
                    ->toggleable()
                    ->options([
                        'Diproses' => 'Diproses',
                        'Selesai'  => 'Selesai',
                    ]),

                IconColumn::make('tampil_di_publik')
                    ->label('Publik')
                    ->boolean()
                    ->toggleable(),
            ])

            ->defaultSort('created_at', 'desc')

            ->filters([
                Tables\Filters\SelectFilter::make('status_laporan')
                    ->label('Status')
                    ->options([
                        'Diproses' => 'Diproses',
                        'Selesai'  => 'Selesai',
                    ]),
                Tables\Filters\SelectFilter::make('kategori_kasus')
                    ->label('Kategori')
                    ->options(LaporanKasus::kategoriKasusOptions()),
                Tables\Filters\TernaryFilter::make('tampil_di_publik')
                    ->label('Ditampilkan di publik'),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                ->label('Beri Hasil')
                ->icon('heroicon-o-pencil-square')
                ->color('warning'),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    \Filament\Actions\BulkAction::make('selesaikan')
                        ->label('Selesaikan Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update([
                            'status_laporan' => 'Selesai',
                        ])),
                ]),
            ])

            ->emptyStateIcon('heroicon-o-exclamation-triangle')
            ->emptyStateHeading('Belum ada laporan kasus')
            ->emptyStateDescription('Laporan kasus dari user akan muncul di sini.');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLaporanKasus::route('/'),
            'create' => Pages\CreateLaporanKasus::route('/create'),
            'edit'   => Pages\EditLaporanKasus::route('/{record}/edit'),
        ];
    }
}
