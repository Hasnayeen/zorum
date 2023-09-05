<?php

namespace App\Models;

use App\Enums\HubUserStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hub extends Model
{
    use HasFactory, SoftDeletes, HasUlids;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $cast = [
        'deleted_at' => 'datetime',
        'status' => HubUserStatus::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function channels(): HasMany
    {
        return $this->hasMany(Channel::class);
    }
}
