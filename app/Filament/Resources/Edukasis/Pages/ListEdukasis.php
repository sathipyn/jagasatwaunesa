<?php

namespace App\Filament\Resources\Edukasis\Pages;

use App\Filament\Resources\Edukasis\EdukasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEdukasis extends ListRecords
{
    protected static string $resource = EdukasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Edukasi'),
        ];
    }
}
