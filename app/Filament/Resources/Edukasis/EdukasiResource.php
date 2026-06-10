<?php

namespace App\Filament\Resources\Edukasis;

use App\Filament\Resources\Edukasis\Pages;
use App\Models\Edukasi;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EdukasiResource extends Resource
{
    protected static ?string $model = Edukasi::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;
    protected static ?string $navigationLabel = 'Data Edukasi';
    protected static ?string $modelLabel = 'Edukasi';
    protected static ?string $pluralModelLabel = 'Data Edukasi';
    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Edukasi')
                ->columns(2)
                ->components([
                    TextInput::make('judul')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug((string) $state))),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    TextInput::make('kategori')
                        ->label('Kategori')
                        ->placeholder('Contoh: Perawatan'),

                    DatePicker::make('published_at')
                        ->label('Tanggal Publish'),

                    TextInput::make('urutan')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),

                    Toggle::make('is_published')
                        ->label('Tampilkan di website')
                        ->default(true),

                    Toggle::make('is_featured')
                        ->label('Tandai sebagai unggulan')
                        ->default(false),
                ]),

            Section::make('Konten')
                ->components([
                    FileUpload::make('cover_image')
                        ->label('Foto Artikel')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('edukasi')
                        ->maxSize(10240)
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => Str::uuid() . '.' . $file->getClientOriginalExtension()
                        )
                        ->panelLayout('grid')
                        ->imagePreviewHeight('250')
                        ->appendFiles()
                        ->helperText('Foto pertama akan dipakai sebagai cover utama. Foto berikutnya tampil sebagai gambar pendukung di tengah artikel.'),

                    Textarea::make('ringkasan')
                        ->label('Ringkasan')
                        ->rows(3)
                        ->maxLength(500),

                    Textarea::make('konten')
                        ->label('Isi Artikel')
                        ->rows(10),

                    Textarea::make('konten_tambahan')
                        ->label('Isi Artikel Tambahan')
                        ->rows(8),

                    FileUpload::make('closing_image')
                        ->label('Gambar Penutup')
                        ->image()
                        ->multiple()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('edukasi')
                        ->maxSize(10240)
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => Str::uuid() . '.' . $file->getClientOriginalExtension()
                        )
                        ->panelLayout('grid')
                        ->imagePreviewHeight('250')
                        ->helperText('Opsional. Dipakai sebagai gambar penutup setelah isi artikel tambahan.'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->width('50px'),

                ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => $record->cover_image[0] ?? null)
                    ->size(48)
                    ->toggleable(),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->toggleable(),

                IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean(),

                IconColumn::make('is_published')
                    ->label('Publish')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('urutan')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Publish'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Unggulan'),
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
            ])
            ->emptyStateIcon('heroicon-o-academic-cap')
            ->emptyStateHeading('Belum ada edukasi')
            ->emptyStateDescription('Artikel edukasi yang dibuat admin akan tampil di sini.');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEdukasis::route('/'),
            'create' => Pages\CreateEdukasi::route('/create'),
            'edit' => Pages\EditEdukasi::route('/{record}/edit'),
        ];
    }
}
