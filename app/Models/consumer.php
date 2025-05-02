<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consumer extends Model
{
    protected $table = 'consumer';
    protected $fillable = ['firstname','lastname','fullname','emailaddress','dob','mobileno','address','consumerheading','city','state','addressline1','addressline2','addressline3','consumerimage','audiovideo'];
}