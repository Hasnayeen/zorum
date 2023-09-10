<?php

namespace App\Http\Middleware;

use App\Models\Hub;
use Closure;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Symfony\Component\HttpFoundation\Response;

class IdentifyHub
{
    public function handle(Request $request, Closure $next): mixed
    {
        $panel = Filament::getCurrentPanel();
        
        if (! $request->query('hub')) {
            return $next($request);
        }

        /** @var Model $user */
        $user = $panel->auth()->user();

        $hub = Hub::where('slug', $request->query('hub'))->firstOrFail();

        // TODO: Check if user is banned or restricted to access hub
        // if (! $user->canAccessHub($hub)) {
        //     abort(404);
        // }

        Filament::setTenant($hub);

        return $next($request);
    }
}
