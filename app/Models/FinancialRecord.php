<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'category',
        'description',
        'amount',
        'transaction_date',
        'payment_method',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
