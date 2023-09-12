<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Widgets\LatestThreads;
use Filament\Actions;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard as BasePage;
use Illuminate\Contracts\Support\Htmlable;
use Livewire\Attributes\Computed;

class Dashboard extends BasePage
{
    public static string $view = 'filament.app.pages.dashboard';

    public function getTitle(): string|Htmlable
    {
        return ' ';
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
                        ->icon('icon-at-sign')
                        ->url(fn (): string => Dashboard::getUrl()),
                    NavigationItem::make('Laravel')
                        ->icon('icon-at-sign')
                        ->url(fn (): string => Dashboard::getUrl()),
                ]),
            NavigationGroup::make('Popular Hubs')
                ->collapsible(true)
                ->items([
                    NavigationItem::make('Livewire')
                        ->icon('icon-at-sign')
                        ->url(fn (): string => Dashboard::getUrl()),
                    NavigationItem::make('Filament')
                        ->icon('icon-at-sign')
                        ->url(fn (): string => Dashboard::getUrl()),
                ]),
        ];
    }

    public function getVisibleHeaderWidgets(): array
    {
        return [
            LatestThreads::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Thread'),
        ];
    }
}
