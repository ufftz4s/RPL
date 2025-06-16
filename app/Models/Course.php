<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'youtube_url',
        'thumbnail',
        'category',
        'level',
        'duration_minutes',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duration_minutes' => 'integer',
    ];
}
