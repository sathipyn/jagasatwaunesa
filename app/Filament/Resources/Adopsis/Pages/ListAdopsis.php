<?php

namespace App\Filament\Resources\Adopsis\Pages;

use App\Filament\Resources\Adopsis\AdopsiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdopsis extends ListRecords
{
    protected static string $resource = AdopsiResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('Tambah Adopsi')];
    }
}
