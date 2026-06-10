<?php
namespace App\Filament\Resources\LaporanKasuses\Pages;
use App\Filament\Resources\LaporanKasuses\LaporanKasusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditLaporanKasus extends EditRecord
{
    protected static string $resource = LaporanKasusResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
