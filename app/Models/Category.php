<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description'
    ];

    // У категории много статей
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'category_id', 'id');
    }

    // У категории много изделий
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
