<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'savings_target_id',
        'amount',
        'saved_date',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'saved_date' => 'date',
    ];

    // Relationship
    public function savingsTarget()
    {
        return $this->belongsTo(SavingsTarget::class);
    }
}
