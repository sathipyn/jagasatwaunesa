<?php

namespace App\Filament\Resources\Adopsis;

use App\Filament\Resources\Adopsis\Pages;
use App\Models\Adopsi;
use BackedEnum;

use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class AdopsiResource extends Resource
{
    protected static ?string $model = Adopsi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Moon;

    protected static ?string $navigationLabel = 'Data Adopsi';
    protected static ?string $modelLabel = 'Adopsi';
    protected static ?string $pluralModelLabel = 'Data Adopsi';

    protected static ?int $navigationSort = 3;

 
    // 🔥 Badge jumlah pending
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status_adopsi', 'Pending')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    // =========================
    // FORM
    // =========================
    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            // 🔹 SECTION 1
            Section::make('Data Utama')
                ->columns(2)
                ->components([

                    Select::make('kucing_id')
                        ->label('Pilih Kucing')
                        ->relationship('kucing', 'nama_kucing')
                        ->searchable()
                        ->required(),
                    Select::make('user_id')
                        ->label('Adopter')
                        ->relationship('user', 'nama_lengkap')
                        ->searchable()
                        ->required(),

                    TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required(),

                    DatePicker::make('tanggal_pengajuan')
                        ->label('Tanggal')
                        ->default(now())
                        ->required(),

                    TextInput::make('no_hp')
                        ->label('No WA')
                        ->tel()
                        ->required()
                        ->rule('regex:/^08[0-9]{8,11}$/'),

                    Select::make('status_adopsi')
                        ->label('Proses')
                        ->options([
                            'Pending'  => 'Pending',
                            'Diterima' => 'Diterima',
                            'Ditolak'  => 'Ditolak',
                        ])
                        ->default('Pending')
                        ->native(false)
                        ->required(),
                ]),

            // 🔹 SECTION 2
            Section::make('Data Kelayakan Adopsi')
                ->columns(2)
                ->components([

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'Bekerja' => 'Bekerja',
                            'Kuliah' => 'Kuliah',
                            'Lainnya' => 'Lainnya',
                        ])
                        ->required(),

                    TextInput::make('domisili')
                        ->required(),

                    TextInput::make('penghasilan')
                        ->numeric()
                        ->prefix('Rp')
                        ->required(),

                    Textarea::make('alasan')
                        ->label('Alasan Mengadopsi')
                        ->columnSpanFull()
                        ->required(),

                    Select::make('pro_dokter_hewan')
                        ->label('Pro Dokter Hewan')
                        ->options([
                            'Ya' => 'Ya',
                            'Tidak' => 'Tidak',
                            'Mungkin' => 'Mungkin',
                        ])
                        ->required(),

                    Select::make('update_kabar')
                        ->label('Siap Update Kabar')
                        ->options([
                            'Ya' => 'Ya',
                            'Tidak' => 'Tidak',
                        ])
                        ->helperText('Minimal 1 bulan sekali')
                        ->required(),
                ]),
        ]);
    }

    // =========================
    // TABLE
    // =========================
    public static function table(Table $table): Table
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
                ->label('Pro Dokter')
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

            ->filters([

                Tables\Filters\SelectFilter::make('status_adopsi')
                    ->label('Status')
                    ->options([
                        'Pending'  => 'Pending',
                        'Diterima' => 'Diterima',
                        'Ditolak'  => 'Ditolak',
                    ]),

                Tables\Filters\SelectFilter::make('kucing_id')
                    ->label('Kucing')
                    ->relationship('kucing', 'nama_kucing'),
            ])

            ->recordActions([

                EditAction::make(),


                // 💬 WhatsApp
                Action::make('hubungi')
                    ->label('Hubungi')
                    ->color('success')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->url(function (Adopsi $record) {

                        $nama   = $record->nama_lengkap ?? 'Adopter';
                        $kucing = $record->kucing->nama_kucing ?? 'kucing';
                        $hp     = preg_replace('/^0/', '62', $record->no_hp ?? '');

                        $pesan = urlencode(
                            "Halo Kak{$nama}, Kami dari JagaSatwa ingin memberi tahu bahwa pengajuan adopsi untuk {$kucing} sedang diproses oleh JagaSatwa yaaa"
                        );

                        return $hp ? "https://wa.me/{$hp}?text={$pesan}" : '#';
                    })
                    ->openUrlInNewTab(),

                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    // =========================
    // PAGES
    // =========================
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAdopsis::route('/'),
            'create' => Pages\CreateAdopsi::route('/create'),
            'edit'   => Pages\EditAdopsi::route('/{record}/edit'),
        ];
    }
}
