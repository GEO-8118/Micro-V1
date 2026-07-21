<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon_url',
        'is_stackable',
        'badge_level',
        'prerequisite_badge_id',
        'pathway_id',
        'is_active',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badges')->withTimestamps();
    }

    public function rules(): HasMany
    {
        return $this->hasMany(BadgeRule::class);
    }
}
