<?php

namespace App\Filament\App\Resources\HubResource\Pages;

use App\Filament\App\Resources\HubResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHub extends ViewRecord
{
    protected static string $resource = HubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
