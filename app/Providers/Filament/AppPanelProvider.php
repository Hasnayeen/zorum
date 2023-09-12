<?php

namespace App\Providers\Filament;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IdentifyHub;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('app')
            ->path('')
            ->colors([
                'primary' => [
                    50 => '#fff9f5',
                    100 => '#ffe6d5',
                    200 => '#fecaaa',
                    300 => '#fda574',
                    400 => '#fb743c',
                    500 => '#f95016',
                    600 => '#ea350c',
                    700 => '#c2250c',
                    800 => '#9a1f12',
                    900 => '#7c1d12',
                    950 => '#430b07',
                ],
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                IdentifyHub::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->login()
            ->registration()
            ->homeUrl('/')
            ->databaseNotifications()
            ->topNavigation()
            ->sidebarCollapsibleOnDesktop(false)
            ->sidebarFullyCollapsibleOnDesktop(false)
            ->favicon(asset('favicon.svg'))
            ->viteTheme('resources/css/app.css');
    }
}
