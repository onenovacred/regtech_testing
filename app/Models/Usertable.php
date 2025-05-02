<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertable extends Model
{
    protected $table = 'user-table';
    protected $fillable = [
        'name',
        'mobile_number',
        'email',
        'messages',
    ];

    protected $casts = [
        'messages' => 'array', // Cast messages to array
    ];
}