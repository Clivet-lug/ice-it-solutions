<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes; // Adding SoftDeletes

    protected $fillable = [
        'title',
        'description',
        'type',
        'technologies',
        'client_name',
        'before_image',
        'after_image',
        'results',
        'is_featured',
        'slug'  // Adding slug
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean'
    ];

    // Image URL accessors
    public function getBeforeImageUrlAttribute()
    {
        return $this->before_image ? Storage::url($this->before_image) : null;
    }

    public function getAfterImageUrlAttribute()
    {
        return $this->after_image ? Storage::url($this->after_image) : null;
    }

    // Helper methods for type
    public static function getTypes()
    {
        return [
            'website' => 'Website Development',
            'software' => 'Software Development',
            'document' => 'Document Formatting',
            'presentation' => 'Presentation Design'
        ];
    }

    // URL generation
    public function getUrlAttribute()
    {
        return route('portfolio.show', $this);
    }

    // Boot method for automatic slug generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                // Generate the initial slug
                $baseSlug = Str::slug($portfolio->title);
                $slug = $baseSlug;
                $counter = 1;

                // Keep checking until we find a unique slug
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $portfolio->slug = $slug;
            }
        });
    }
}