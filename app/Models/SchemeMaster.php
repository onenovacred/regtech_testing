<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApiMaster;

class SchemeMaster extends Model
{
    use HasFactory;
    protected $table = "scheme_master";

    public function api_master(){
        return $this->belongsTo(ApiMaster::class,'api_id','id');
    }
}
