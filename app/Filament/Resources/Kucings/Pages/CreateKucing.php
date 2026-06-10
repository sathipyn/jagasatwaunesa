<?php

namespace App\Filament\Resources\Kucings\Pages;

use App\Filament\Resources\Kucings\KucingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKucing extends CreateRecord
{
    protected static string $resource = KucingResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
