<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\businesskyc;
use App\Models\consumer;
use App\Models\businesstype;

class business extends Model
{
    protected $table = 'business';
    protected $fillable = ['businesskycid','businessname','businessadress','businesstypeid','uploaddocument','customerid','businessheading'];
    public function businesskyc(){
        return $this->belongsTo(businesskyc::class,'businesskycid','id');
    }
    public function businesstype(){
        return $this->belongsTo(businesstype::class,'businesstypeid','id');
    }
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
