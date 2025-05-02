<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requireddetails extends Model
{
    protected $table = 'requireddetails';
    protected $fillable = ['uploadeddocumentname','uploadfile','pannumber','aadhaarnumber','customerid','requireddetailsheading'];
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
