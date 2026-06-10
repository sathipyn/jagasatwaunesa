<?php
namespace App\Filament\Resources\LaporanKasuses\Pages;
use App\Filament\Resources\LaporanKasuses\LaporanKasusResource;
use Filament\Resources\Pages\CreateRecord;
class CreateLaporanKasus extends CreateRecord
{
    protected static string $resource = LaporanKasusResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
