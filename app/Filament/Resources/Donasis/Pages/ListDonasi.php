<?php

namespace App\Filament\Resources\Donasis\Pages;

use App\Filament\Resources\Donasis\DonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonasi extends ListRecords
{
    protected static string $resource = DonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()->label('Tambah Donasi')];
    }
}
