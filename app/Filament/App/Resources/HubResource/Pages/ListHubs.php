<?php

namespace App\Filament\App\Resources\HubResource\Pages;

use App\Filament\App\Resources\HubResource;
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
