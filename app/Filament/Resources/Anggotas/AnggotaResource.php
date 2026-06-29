<?php

namespace App\Filament\Resources\Anggotas;

use App\Filament\Resources\Anggotas\Pages;
use App\Models\Anggota;
use BackedEnum;
use UnitEnum;

use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\Width;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected static ?string $navigationLabel = 'Data Anggota';
    protected static string|UnitEnum|null $navigationGroup = 'Data Internal';
    protected static ?string $modelLabel = 'Anggota';
    protected static ?string $pluralModelLabel = 'Data Anggota';
    protected static ?int $navigationSort = 1;

    
    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Pribadi Anggota')
                ->description('Isi informasi lengkap anggota komunitas JagaSatwa UNESA.')
                ->icon('heroicon-o-user')
                ->columns(3)
                ->extraAttributes(['class' => 'mb-4 border border-gray-200 rounded-xl p-4 shadow-sm'])
                ->components([
                    TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(100)
                        ->placeholder('Masukkan nama lengkap'),

                    Select::make('status_keanggotaan')
                        ->label('Status Keanggotaan')
                        ->options([
                            'aktif' => 'Aktif',
                            'tidak aktif' => 'Tidak Aktif',
                        ])
                        ->default('aktif')
                        ->required()
                        ->native(false),
                    
                    TextInput::make('no_hp')
                        ->label('Nomor Handphone')
                        ->tel()
                        ->maxLength(15)
                        ->placeholder('Contoh: 081234567890'),
                ]),

            Section::make('Informasi Akademik & Organisasi')
                ->description('Data jabatan, divisi, dan informasi akademik anggota.')
                ->icon('heroicon-o-academic-cap')
                ->columns(3)
                ->extraAttributes(['class' => 'mb-4 border border-gray-200 rounded-xl p-4 shadow-sm'])
                ->components([
                    Select::make('jabatan')
                        ->label('Jabatan')
                        ->options([
                            'Ketua'              => 'Ketua Umum',
                            'Wakil Ketua'        => 'Wakil Ketua',
                            'Sekretaris'         => 'Sekretaris',
                            'Bendahara'          => 'Bendahara',
                            'Ketua Divisi'       => 'Ketua Divisi',
                            'Anggota'            => 'Anggota',
                        ])
                        ->searchable()
                        ->native(false)
                        ->placeholder('Pilih jabatan'),

                    Select::make('divisi')
                        ->label('Divisi')
                        ->options([
                            'RnT'   => 'Rescue & Treatment',
                            'RnD' => 'Research & Development',
                            'Fundraising' => 'Fundraising',
                            'Humas'  => 'Hubungan Masyarakat',
                            'Umum'                 => 'Umum',
                            'Medkraf'        => 'Media Kreatif',
                        ])
                        ->searchable()
                        ->native(false)
                        ->placeholder('Pilih divisi'),

                    Select::make('fakultas')
                        ->label('Fakultas')
                        ->options([
                            'FEB' => 'Fakultas Ekonomi & Bisnis',
                            'FT'  => 'Fakultas Teknik',
                            'FIP' => 'Fakultas Ilmu Pendidikan',
                            'FMIPA' => 'Fakultas Matematika & Ilmu Pengetahuan Alam',
                            'FBS' => 'Fakultas Bahasa & Seni',
                            'FH' => 'Fakultas Hukum',
                            'FIKK' => 'Fakultas Ilmu Keolahragaan & Kesehatan',
                            'FISIPOL' => 'Fakultas Ilmu Sosial & Ilmu Politik',
                            'FV' => 'Fakultas Vokasi',
                            'FK' => 'Fakultas Kedokteran',
                            'FKP' => 'Fakultas Ketahanan Pangan',
                            'FP' => 'Fakultas Psikologi',

                        ])
                        ->searchable()
                        ->native(false)
                        ->placeholder('Pilih fakultas'),

                    TextInput::make('jurusan')
                        ->label('Jurusan')
                        ->maxLength(50)
                        ->placeholder('Contoh: Teknik Informatika'),

                    TextInput::make('angkatan')
                        ->label('Angkatan')
                        ->maxLength(10)
                        ->placeholder('Contoh: 2022'),
                ]),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Data Pribadi Anggota')
                    ->icon('heroicon-o-user')
                    ->columns(3)
                    ->components([
                        TextEntry::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->placeholder('-'),

                        TextEntry::make('status_keanggotaan')
                            ->label('Status Keanggotaan')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                'aktif' => 'Aktif',
                                'tidak aktif' => 'Tidak Aktif',
                                default => $state ?? '-',
                            })
                            ->color(fn (?string $state): string => match ($state) {
                                'aktif' => 'success',
                                'tidak aktif' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('no_hp')
                            ->label('Nomor Handphone')
                            ->copyable()
                            ->placeholder('-'),
                    ]),

                Section::make('Informasi Akademik & Organisasi')
                    ->icon('heroicon-o-academic-cap')
                    ->columns(2)
                    ->components([
                        TextEntry::make('jabatan')
                            ->label('Jabatan')
                            ->badge()
                            ->color('info')
                            ->placeholder('-'),

                        TextEntry::make('divisi')
                            ->label('Divisi')
                            ->badge()
                            ->color('warning')
                            ->placeholder('-'),

                        TextEntry::make('fakultas')
                            ->label('Fakultas')
                            ->badge()
                            ->color('primary')
                            ->placeholder('-'),

                        TextEntry::make('jurusan')
                            ->label('Jurusan')
                            ->placeholder('-'),

                        TextEntry::make('angkatan')
                            ->label('Angkatan')
                            ->badge()
                            ->color('gray')
                            ->placeholder('-'),
                    ]),
            ]);
    }

    // TABLE
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->width('50px')
                    ->rowIndex(),

                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('divisi')
                    ->label('Divisi')
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('fakultas')
                    ->label('Fakultas')
                    ->badge()
                    ->color('primary')
                    ->toggleable(),

                TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('angkatan')
                    ->label('Angkatan')
                    ->badge()
                    ->color('gray')
                    ->toggleable(),

                TextColumn::make('status_keanggotaan')
                    ->label('Status')
                    ->badge()
                    ->toggleable()
                    ->color(fn(string $state): string => match ($state) {
                        'aktif'       => 'success',
                        'tidak aktif' => 'danger',
                        default       => 'gray',
                    }),
                TextColumn::make('no_hp')
                    ->label('No HP')
                    ->searchable()
                    ->copyable()
                    ->url(fn ($record) => $record->no_hp 
                        ? 'https://wa.me/' . preg_replace('/^0/', '62', $record->no_hp)
                        : null
                    )
                    ->openUrlInNewTab()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->toggleable(),
            ])
            ->defaultSort('nama_lengkap', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('status_keanggotaan')
                    ->label('Status')
                    ->options([
                        'aktif' => 'Aktif',
                        'tidak aktif' => 'Tidak Aktif',
                    ]),

                Tables\Filters\SelectFilter::make('divisi')
                    ->label('Divisi')
                    ->options([
                        'RnT'   => 'Rescue & Treatment',
                        'RnD' => 'Research & Development',
                        'Fundraising' => 'Fundraising',
                        'Humas'  => 'Hubungan Masyarakat',
                        'Medkraf'        => 'Media Kreatif',
                        'Umum'                 => 'Umum',
                    ]),

                Tables\Filters\SelectFilter::make('jabatan')
                    ->label('Jabatan')
                    ->options([
                        'Ketua'              => 'Ketua Umum',
                        'Wakil Ketua'        => 'Wakil Ketua',
                        'Sekretaris'         => 'Sekretaris',
                        'Bendahara'          => 'Bendahara',
                        'Ketua Divisi'       => 'Ketua Divisi',
                        'Anggota'            => 'Anggota',
                    ]),
                Tables\Filters\SelectFilter::make('fakultas')
                    ->label('Fakultas')
                    ->options([
                            'FEB' => 'FEB',
                            'FT'  => 'FT',
                            'FIP' => 'FIP',
                            'FMIPA' => 'FMIPA',
                            'FBS' => 'FBS',
                            'FH' => 'FH',
                            'FIKK' => 'FIKK',
                            'FISIPOL' => 'FISIPOL',
                            'FV' => 'FV',
                            'FK' => 'FK',
                            'FKP' => 'FKP',
                            'FP' => 'FP',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalWidth(Width::FiveExtraLarge),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    \Filament\Actions\BulkAction::make('nonaktifkan')
                        ->label('Nonaktifkan Terpilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn($records) => $records->each->update([
                            'status_keanggotaan' => 'tidak aktif'
                        ])),

                    \Filament\Actions\BulkAction::make('aktifkan')
                        ->label('Aktifkan Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn($records) => $records->each->update([
                            'status_keanggotaan' => 'aktif'
                        ])),
                ]),
            ])
            ->emptyStateIcon('heroicon-o-user-group')
            ->emptyStateHeading('Belum ada anggota')
            ->emptyStateDescription('Tambahkan anggota komunitas JagaSatwa pertama.');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAnggotas::route('/'),
            'create' => Pages\CreateAnggota::route('/create'),
            'edit'   => Pages\EditAnggota::route('/{record}/edit'),
        ];
    }
}
