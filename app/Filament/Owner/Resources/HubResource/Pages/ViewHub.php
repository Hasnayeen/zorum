<?php

namespace App\Filament\Owner\Resources\HubResource\Pages;

use App\Filament\Owner\Resources\HubResource;
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
