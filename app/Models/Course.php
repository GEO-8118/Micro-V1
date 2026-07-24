<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'level',
        'duration',
        'instructor',
        'lessons_count',
        'enrolled_count',
        'passing_score',
        'is_featured',
        'is_published',
        'thumbnail_url',
        'submitted_by',
        'status',
        'review_note',
        'approved_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'approved_at' => 'datetime',
    ];
}
