<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $fillable = [

    ];

    protected $casts = [
        'is_processed' => 'boolean',
    ];
}
