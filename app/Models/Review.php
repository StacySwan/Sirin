<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'name',
        'author',
        'rating',
        'text',
        'source_url',
        'source',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'rating' => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}


