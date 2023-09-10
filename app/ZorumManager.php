<?php

namespace App;

use App\Models\Hub;

class ZorumManager
{
    use Concerns\HasHub;

    public function getHubs()
    {
        return Hub::all();
    }

    public function hasHubs()
    {
        return Hub::count() > 1;
    }

    public function getHub($slug)
    {
        return Hub::where('slug', $slug)->firstOrFail();
    }

    public function getCurrentHub()
    {
        return Hub::where('slug', request()->query('hub'))->firstOrFail();
    }

    public function getHubsAccessibleToUser()
    {
        return $this->getHubs()->filter(fn ($hub) => auth()->user()->canAccessHub($hub));
    }
}
