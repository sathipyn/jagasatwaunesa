<?php

namespace App\Filament\Resources\PenggunaanDanas\Pages;

use App\Filament\Resources\PenggunaanDanas\PenggunaanDanaResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePenggunaanDana extends CreateRecord
{
    protected static string $resource = PenggunaanDanaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
