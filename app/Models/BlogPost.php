<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class BlogPost extends Model
{
    use HasSlug; //это специальный расширитель мдели, которая сществует ('slug'), в классе
    protected $table = 'blog_posts';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'author_name',
        'published_at',
        'is_published',
        'og_image',
        'status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('status', 'active')
            ->where(function (Builder $q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    // Ищем статью по slug, а не по id (для красивых ссылок)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

