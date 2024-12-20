<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 
        'name', 
        'email', 
        'description', 
        'file_path', 
        'status'];
    protected $casts = ['attachments' => 'array'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
