<?php

namespace App\Filament\Resources\Kucings;

use App\Filament\Resources\Kucings\RelationManagers\AdopsiRelationManager;
use App\Filament\Resources\Kucings\Pages;
use App\Filament\Resources\Kucings\RelationManagers\KomentarRelationManager;
use App\Models\Kucing;
use BackedEnum;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;


use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;


class KucingResource extends Resource
{
    protected static ?string $model = Kucing::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Heart;
    protected static ?string $navigationLabel = 'Data Kucing';
    protected static ?string $modelLabel = 'Kucing';
    protected static ?string $pluralModelLabel = 'Data Kucing';
    protected static ?int $navigationSort = 2;



    // ✅ FORM
    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Identitas Kucing')
                ->columns(2)
                ->components([

                    TextInput::make('nama_kucing')
                        ->label('Nama Kucing')
                        ->maxLength(100),

                    Select::make('jenis_kelamin')
                        ->options([
                            'Jantan' => 'Jantan',
                            'Betina' => 'Betina',
                            'Tidak Diketahui' => 'Tidak Diketahui',
                        ])
                        ->required()
                        ->native(false),

                    TextInput::make('warna_kucing')
                        ->label('Warna'),

                    Textarea::make('lokasi_kucing')
                        ->label('Lokasi')
                        ->rows(2)
                        ->columnSpanFull(),

                ]),

            Section::make('Kesehatan')
                ->columns(2)
                ->components([

                    Select::make('steril_kucing')
                        ->label('Steril')
                        ->options([
                            'Sudah' => 'Sudah',
                            'Belum' => 'Belum',
                            'Tidak Diketahui' => 'Tidak Diketahui',
                        ])
                        ->native(false),

                    Select::make('vaksin_kucing')
                        ->label('Vaksin')
                        ->options([
                            'Sudah' => 'Sudah',
                            'Belum' => 'Belum',
                            'Tidak Diketahui' => 'Tidak Diketahui',
                        ])
                        ->native(false),

                    Toggle::make('open_adopsi')
                        ->label('Open Adopsi')
                        ->default(false)
                        ->columnSpanFull(),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            Section::make('Foto')
                ->components([
                    FileUpload::make('foto')
                        ->label('Foto Kucing')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('kucing')
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
            ->columns([

                TextColumn::make('no')
                    ->label('No')
                    ->sortable()
                    ->width('50px')
                    ->rowIndex(),

                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => $record->foto[0] ?? null)
                    ->circular()
                    ->size(50)
                    ->toggleable(),

                TextColumn::make('nama_kucing')
                    ->label('Nama')
                    ->searchable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('jenis_kelamin')
                    ->badge()
                    ->toggleable()
                    ->color(fn ($state) => match ($state) {
                        'Jantan' => 'info',
                        'Betina' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('warna_kucing')
                    ->label('Warna')
                    ->toggleable(),

                TextColumn::make('steril_kucing')
                    ->label('Steril')
                    ->badge()
                    ->toggleable()
                    ->color(fn ($state) => match ($state) {
                        'Sudah' => 'success',
                        'Belum' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('vaksin_kucing')
                    ->label('Vaksin')
                    ->badge()
                    ->toggleable()
                    ->color(fn ($state) => match ($state) {
                        'Sudah' => 'success',
                        'Belum' => 'warning',
                        default => 'gray',
                    }),

                ToggleColumn::make('open_adopsi')
                    ->label('Adopsi')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->sortable()
                    ->toggleable(),

                    TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->options([
                        'Jantan' => 'Jantan',
                        'Betina' => 'Betina',
                    ]),

                Tables\Filters\TernaryFilter::make('open_adopsi')
                    ->label('Open Adopsi'),

                Tables\Filters\SelectFilter::make('steril_kucing')
                    ->label('Steril')
                    ->options([
                        'Sudah' => 'Sudah',
                        'Belum' => 'Belum',
                    ]),
                Tables\Filters\SelectFilter::make('vaksin_kucing')
                    ->label('Vaksin')
                    ->options([
                        'Sudah' => 'Sudah',
                        'Belum' => 'Belum',
                    ]),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

 
       public static function getRelations(): array
    {
        return [
            AdopsiRelationManager::class,
            KomentarRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKucings::route('/'),
            'create' => Pages\CreateKucing::route('/create'),
            'edit'   => Pages\EditKucing::route('/{record}/edit'),
            'view' => Pages\ViewKucing::route('/{record}'),
        ];
    }
}
