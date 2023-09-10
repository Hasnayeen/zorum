<?php

namespace App\Filament\App\Resources\HubResource\Pages;

use App\Filament\App\Resources\HubResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHub extends EditRecord
{
    protected static string $resource = HubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
