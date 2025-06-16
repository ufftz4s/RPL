<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'current_amount',
        'frequency',
        'frequency_amount',
        'target_date',
        'start_date',
        'status',
        'description'
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'frequency_amount' => 'decimal:2',
        'target_date' => 'date',
        'start_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function progress()
    {
        return $this->hasMany(SavingsProgress::class);
    }

    // Helper methods
    public function getProgressPercentageAttribute()
    {
        return $this->target_amount > 0 ? ($this->current_amount / $this->target_amount) * 100 : 0;
    }
}
