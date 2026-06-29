<?php

namespace App\Filament\Resources\PenggunaanDanas\Pages;

use App\Filament\Resources\PenggunaanDanas\PenggunaanDanaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenggunaanDana extends ListRecords
{
    protected static string $resource = PenggunaanDanaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()->label('Tambah Penggunaan Dana')];
    }
}
