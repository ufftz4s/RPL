<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consultation_type',
        'topic',
        'description',
        'price',
        'status',
        'scheduled_at',
        'duration_minutes',
        'payment_status',
        'payment_method',
        'consultant_notes',
        'rating',
        'review'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'scheduled_at' => 'datetime',
        'duration_minutes' => 'integer',
        'rating' => 'integer',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
