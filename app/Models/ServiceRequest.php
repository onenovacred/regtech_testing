<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{

    protected $table = 'service_requests';
    protected $fillable = ['service', 'name', 'mobile_number', 'email', 'messages'];

    protected $casts = [
        'messages' => 'array', // Cast messages to array
    ];
}