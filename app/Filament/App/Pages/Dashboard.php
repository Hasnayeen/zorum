<?php

namespace App\Filament\App\Pages;

use Livewire\Attributes\Computed;
use Filament\Pages\Dashboard as BasePage;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BasePage
{
    public static string $view = 'filament.app.pages.dashboard';

    public function getTitle(): string|Htmlable
    {
        return '';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    #[Computed]
    public function navigation()
    {
        return [
            NavigationGroup::make('')
                ->collapsible(false)
                ->items([
                    // NavigationItem::make('Dashboard')
                    //     ->icon('heroicon-o-home')
                    //     ->isActiveWhen(fn (): bool => request()->routeIs('filament.app.pages.dashboard'))
                    //     ->url(fn (): string => Dashboard::getUrl()),
                ]),
        ];
    }
}
