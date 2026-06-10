<?php

namespace App\Filament\Resources\Adopsis\Pages;

use App\Filament\Resources\Adopsis\AdopsiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdopsi extends CreateRecord
{
    protected static string $resource = AdopsiResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
