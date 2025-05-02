<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentname extends Model
{
    use HasFactory;
    protected $table = 'documentdetails';
    protected $fillable = ['documentname'];
    // public function customer(){
    //     return $this->belongsTo(consumer::class,'customerid','id');
    // }
}
