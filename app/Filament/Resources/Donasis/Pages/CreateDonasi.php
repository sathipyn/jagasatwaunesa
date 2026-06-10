<?php
namespace App\Filament\Resources\Donasis\Pages;
use App\Filament\Resources\Donasis\DonasiResource;
use Filament\Resources\Pages\CreateRecord;
class CreateDonasi extends CreateRecord
{
    protected static string $resource = DonasiResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
