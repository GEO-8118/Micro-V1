<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompetencyUnit extends Model
{
    protected $table = 'competency_units';

    protected $fillable = [
        'competency_category_id',
        'title',
        'description',
        'order',
        'is_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CompetencyCategory::class, 'competency_category_id');
    }

    public function levels(): HasMany
    {
        return $this->hasMany(CompetencyLevel::class);
    }

    public function outcomes(): HasMany
    {
        return $this->hasMany(CompetencyOutcome::class);
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(CompetencyProgress::class);
    }
}
