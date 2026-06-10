<?php

namespace App\Filament\Resources\Kucings\Pages;

use App\Filament\Resources\Kucings\KucingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKucing extends ViewRecord
{
    protected static string $resource = KucingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
