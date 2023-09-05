<?php

namespace App\Filament\Owner\Resources\HubResource\Pages;

use App\Filament\Owner\Resources\HubResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHubs extends ListRecords
{
    protected static string $resource = HubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
