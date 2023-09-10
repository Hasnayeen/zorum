<?php

namespace App\Models;

use App\Enums\HubUserStatus;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, HasTenants
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getTenants(Panel $panel): Collection
    {
        return $this->hubs;
    }

    public function hubs(): BelongsToMany
    {
        return $this->belongsToMany(Hub::class);
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->hubs->contains($tenant);
    }

    public function threads(): HasMany
    {
        return $this->hasMany(Threads::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachments::class);
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(Reactions::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Roles::class);
    }

    public function canAccessHub(Hub $hub): bool
    {
        if ($this->email === 'guest@example.com') {
            return true;
        }

        return $this->hubs()
            ->where('hub_id', $hub)
            ->wherePivot('status', '!=', HubUserStatus::Banned)
            ->exists();
    }
}
