<?php

namespace App\Filament\Resources\Kucings\Pages;

use App\Filament\Resources\Kucings\KucingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;


class EditKucing extends EditRecord
{
    protected static string $resource = KucingResource::class;
    protected function getFormActions(): array
        {
            return [];
        }

    protected function getHeaderActions(): array
    {
        return [
            
            Actions\Action::make('save')
                ->label('Save Changes')
                ->action('save')
                ->color('primary'), 

            
            Actions\Action::make('cancel')
                ->label('Cancel')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),

            
            Actions\DeleteAction::make()
                ->color('danger'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
