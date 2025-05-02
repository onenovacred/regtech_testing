<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\consumer;

class agreementpolicy extends Model
{
    protected $table = 'agreementpolicy';
    protected $fillable = ['customerid','agreementupload','agreement','agreementheading'];
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
