<?php
// app/Models/Portfolio.php

namespace App\Models;

use Illuminate\Support\Str;
use App\Constants\PortfolioConstants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'sub_type',
        'client_name',
        'before_image',
        'after_image',
        'features',
        'technologies_used',
        'project_status',
        'completion_date',
        'complexity_level',
        'challenges',
        'solutions',
        'live_url',
        'github_url',
        'access_type',
        'user_roles',
        'user_base',
        'modules',
        'sample_file',
        'formatting_style',
        'number_of_pages',
        'document_type',
        'confidentiality_level',
        'meta_data',
        'client_testimonial',
        'client_position',
        'testimonial_date',
        'is_featured'
    ];

    protected $casts = [
        'technologies' => 'array',
        'features' => 'array',
        'technologies_used' => 'array',
        'user_roles' => 'array',
        'modules' => 'array',
        'meta_data' => 'array',
        'completion_date' => 'date',
        'testimonial_date' => 'date',
        'is_featured' => 'boolean'
    ];

    // URL Accessors
    public function getBeforeImageUrlAttribute()
    {
        return $this->before_image ? Storage::url($this->before_image) : null;
    }

    public function getAfterImageUrlAttribute()
    {
        return $this->after_image ? Storage::url($this->after_image) : null;
    }

    public function getSampleFileUrlAttribute()
    {
        return $this->sample_file ? Storage::url($this->sample_file) : null;
    }

    // Helper Methods
    public function getSubTypes()
    {
        return PortfolioConstants::SUB_TYPES[$this->type] ?? [];
    }

    public function isWebsite()
    {
        return $this->type === 'website';
    }

    public function isWebApp()
    {
        return $this->type === 'webapp';
    }

    public function isDocument()
    {
        return $this->type === 'document';
    }

    public function isPresentation()
    {
        return $this->type === 'presentation';
    }

    public function isSoftware()
    {
        return $this->type === 'software';
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('confidentiality_level', 'public');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Format methods
    public function getFormattedCompletionDate()
    {
        return $this->completion_date ? $this->completion_date->format('M Y') : null;
    }

    public function getFormattedTestimonialDate()
    {
        return $this->testimonial_date ? $this->testimonial_date->format('M Y') : null;
    }

    public function getTypeLabel()
    {
        return PortfolioConstants::PROJECT_TYPES[$this->type] ?? $this->type;
    }

    public function getSubTypeLabel()
    {
        return PortfolioConstants::SUB_TYPES[$this->type][$this->sub_type] ?? $this->sub_type;
    }

    public function getStatusLabel()
    {
        return PortfolioConstants::PROJECT_STATUS[$this->project_status] ?? $this->project_status;
    }

    public function getConfidentialityLabel()
    {
        return PortfolioConstants::CONFIDENTIALITY_LEVELS[$this->confidentiality_level] ?? $this->confidentiality_level;
    }

    public function getComplexityLabel()
    {
        return PortfolioConstants::COMPLEXITY_LEVELS[$this->complexity_level] ?? $this->complexity_level;
    }

    public function getTechnologiesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true);
        }
        return $value;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                $baseSlug = Str::slug($portfolio->title);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $portfolio->slug = $slug;
            }
        });
    }
}