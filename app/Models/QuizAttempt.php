<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'answers',
        'score',
        'total_questions',
        'correct_answers',
        'is_passed',
        'time_taken_seconds',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'score' => 'integer',
        'total_questions' => 'integer',
        'correct_answers' => 'integer',
        'is_passed' => 'boolean',
        'time_taken_seconds' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
