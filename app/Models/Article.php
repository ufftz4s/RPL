<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'excerpt',
        'featured_image',
        'category',
        'tags',
        'read_time_minutes',
        'views',
        'is_published',
        'author_id',
        'published_at'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'views' => 'integer',
        'read_time_minutes' => 'integer',
        'published_at' => 'datetime',
    ];

    // Relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
