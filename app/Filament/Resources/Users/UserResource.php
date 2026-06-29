<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages;
use App\Filament\Resources\Users\RelationManagers\AdopsiRelationManager;
use App\Filament\Resources\Users\RelationManagers\DonasiRelationManager;
use App\Filament\Resources\Users\RelationManagers\LaporanKasusRelationManager;
use App\Models\User;
use BackedEnum;
use UnitEnum;

use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;
    protected static ?string $navigationLabel = 'Data User';
    protected static string|UnitEnum|null $navigationGroup = 'Data Internal';
    protected static ?string $modelLabel = 'User';
    protected static ?string $pluralModelLabel = 'Data User';
    protected static ?int $navigationSort = 2;

    
    // FORM (view only, admin tidak buat user)
    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informasi User')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->components([

                    TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(100),

                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(100),

                    TextInput::make('username')
                        ->label('Username')
                        ->required()
                        ->maxLength(100),
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

                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->badge()
                    ->color('info')
                    ->toggleable(),

                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color('warning')
                    ->toggleable(),

                TextColumn::make('donasi_count')
                    ->label('Donasi')
                    ->counts('donasi')
                    ->badge()
                    ->color('success')
                    ->toggleable(),

                TextColumn::make('laporan_kasus_count')
                    ->label('Laporan')
                    ->counts('laporanKasus')
                    ->badge()
                    ->color('danger')
                    ->toggleable(),

                TextColumn::make('adopsi_count')
                    ->label('Adopsi')
                    ->counts('adopsi')
                    ->badge()
                    ->color('primary')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])

            ->defaultSort('created_at', 'desc')

            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name'),
            ])

            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateHeading('Belum ada user')
            ->emptyStateDescription('User akan muncul setelah ada yang mendaftar.');
    }

    public static function getRelations(): array
    {
        return [
            AdopsiRelationManager::class,
            DonasiRelationManager::class,
            LaporanKasusRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }
}
