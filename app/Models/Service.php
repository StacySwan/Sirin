<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasSlug;
    protected string $slugSource = 'name';

    protected $table = 'services';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_description',
        'is_published',
        'sort',
        'og_image'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort' => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

