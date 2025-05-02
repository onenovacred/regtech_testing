<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiMaster extends Model
{
    use HasFactory;
    protected $table = "api_master";

    public function api_group(){
        return $this->belongsTo(ApiGroup::class,'api_group_id','id');
    }
}
