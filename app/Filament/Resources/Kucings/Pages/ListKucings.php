<?php

namespace App\Filament\Resources\Kucings\Pages;

use App\Filament\Resources\Kucings\KucingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKucings extends ListRecords
{
    protected static string $resource = KucingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('Tambah Kucing')];
    }
}
