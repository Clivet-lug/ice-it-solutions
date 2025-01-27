<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PricingRequest extends Model
{
    use LogsActivity;

    protected $fillable = [
        'pricing_id',
        'name',
        'email',
        'description',
        'requirements',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'requirements' => 'array'
    ];

    protected static $logAttributes = ['status'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'pricing_request';

    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }
}