<?php

namespace App\Filament\Resources\Edukasis\Pages;

use App\Filament\Resources\Edukasis\EdukasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEdukasi extends EditRecord
{
    protected static string $resource = EdukasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
