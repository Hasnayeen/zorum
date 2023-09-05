<?php

namespace App\Filament\Member\Resources\ThreadResource\Pages;

use App\Filament\Member\Resources\ThreadResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewThread extends ViewRecord
{
    protected static string $resource = ThreadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
