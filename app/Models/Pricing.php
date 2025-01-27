<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'features',
        'button_text',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'features' => 'array'
    ];

    public function requests()
    {
        return $this->hasMany(PricingRequest::class);
    }
}