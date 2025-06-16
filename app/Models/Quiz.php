<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'difficulty',
        'time_limit_minutes',
        'passing_score',
        'is_active'
    ];

    protected $casts = [
        'time_limit_minutes' => 'integer',
        'passing_score' => 'integer',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
