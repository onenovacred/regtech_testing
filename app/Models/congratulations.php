<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

   
class congratulations extends Model
{
    protected $table = 'congratulations';
    protected $fillable = ['customerid','uploadcongfile','message','congratulationsheading'];
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
