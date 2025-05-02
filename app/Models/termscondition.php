<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\consumer;

class termscondition extends Model
{
    protected $table = 'termscondition';
    protected $fillable = ['customerid','termscondition','crifapiscore','loansactioned','termsconditionheading'];
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
