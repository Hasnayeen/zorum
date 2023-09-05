<?php

namespace App\Filament\Admin\Pages;

use App\Enums\HubUserStatus;
use App\Models\Hub;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterHub extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register hub';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('description'),
            ]);
    }

    protected function handleRegistration(array $data): Hub
    {
        $hub = Hub::create($data);

        $hub->users()->attach(auth()->user(), ['status' => HubUserStatus::Owner]);

        return $hub;
    }
}
