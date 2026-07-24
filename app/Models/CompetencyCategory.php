<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompetencyCategory extends Model
{
    protected $table = 'competency_categories';

    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];

    public function units(): HasMany
    {
        return $this->hasMany(CompetencyUnit::class);
    }
}
