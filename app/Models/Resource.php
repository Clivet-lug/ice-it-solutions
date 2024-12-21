<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'description',
        'content',
        'file_path',
        'is_featured',
        'is_public'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_public' => 'boolean'
    ];
}
