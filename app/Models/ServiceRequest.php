<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceRequest extends Model
{
    use LogsActivity;

    protected $fillable = [
        'service_id',
        'name',
        'email',
        'description',
        'status',
        'admin_notes',
        'attachments'
    ];

    protected $casts = [
        'attachments' => 'array'
    ];

    // Activity log settings
    protected static $logAttributes = ['status'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'service_request';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Service request status has been {$eventName}";
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
