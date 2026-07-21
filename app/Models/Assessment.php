<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    protected $table = 'assessments';

    protected $fillable = [
        'user_id',
        'competency_unit_id',
        'competency_level_id',
        'type',
        'title',
        'description',
        'passing_score',
        'status',
        'score',
        'feedback',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function competencyUnit(): BelongsTo
    {
        return $this->belongsTo(CompetencyUnit::class, 'competency_unit_id');
    }

    public function competencyLevel(): BelongsTo
    {
        return $this->belongsTo(CompetencyLevel::class, 'competency_level_id');
    }
}
