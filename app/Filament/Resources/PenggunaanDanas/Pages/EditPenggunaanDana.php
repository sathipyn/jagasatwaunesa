<?php

namespace App\Filament\Resources\PenggunaanDanas\Pages;

use App\Filament\Resources\PenggunaanDanas\PenggunaanDanaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenggunaanDana extends EditRecord
{
    protected static string $resource = PenggunaanDanaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
