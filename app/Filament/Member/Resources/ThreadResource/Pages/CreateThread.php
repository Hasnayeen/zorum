<?php

namespace App\Filament\Member\Resources\ThreadResource\Pages;

use App\Enums\ThreadStatus;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Member\Resources\ThreadResource;

class CreateThread extends CreateRecord
{
    protected static string $resource = ThreadResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = $data['draft'] ? ThreadStatus::Draft : ThreadStatus::Pending;
        $data['user_id'] = auth()->id();
        $data['hub_id'] = Filament::getTenant()->id;
        unset($data['draft']);

        return $data;
    }
}
