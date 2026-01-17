<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'summary',
        'category',
        'tags',
        'is_published',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
    ];
}
