<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Tambahkan ini

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // Tambahkan HasApiTokens

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function financialRecords()
    {
        return $this->hasMany(FinancialRecord::class);
    }

    public function savingsTargets()
    {
        return $this->hasMany(SavingsTarget::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function chatbotConversations()
    {
        return $this->hasMany(ChatbotConversation::class);
    }
}
