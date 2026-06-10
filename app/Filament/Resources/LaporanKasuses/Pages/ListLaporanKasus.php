<?php
namespace App\Filament\Resources\LaporanKasuses\Pages;
use App\Filament\Resources\LaporanKasuses\LaporanKasusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListLaporanKasus extends ListRecords
{
    protected static string $resource = LaporanKasusResource::class;
    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()->label('Tambah Laporan')];
    }
}
