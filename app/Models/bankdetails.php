<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\consumer;

class bankdetails extends Model
{
    protected $table = 'bankdetails';
    protected $fillable = ['customerid','bankname','accountnumber','accounttype','ifsccode','bankdetailsheading'];
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
