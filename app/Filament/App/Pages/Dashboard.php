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
            NavigationGroup::make('Pinned Hubs')
                ->collapsible(true)
                ->items([
                    NavigationItem::make('Meta')
                        ->icon('heroicon-o-at-symbol')
                        ->url(fn (): string => Dashboard::getUrl()),
                    NavigationItem::make('Laravel')
                        ->icon('heroicon-o-at-symbol')
                        ->url(fn (): string => Dashboard::getUrl()),
                ]),
            NavigationGroup::make('Popular Hubs')
                ->collapsible(true)
                ->items([
                    NavigationItem::make('Livewire')
                        ->icon('heroicon-o-at-symbol')
                        ->url(fn (): string => Dashboard::getUrl()),
                    NavigationItem::make('Filament')
                        ->icon('heroicon-o-at-symbol')
                        ->url(fn (): string => Dashboard::getUrl()),
                ]),
        ];
    }
}
