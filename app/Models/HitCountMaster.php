<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApiMaster;

class HitCountMaster extends Model
{
    use HasFactory;

    protected $table = "hit_count_master";

    public function api_master(){
        return $this->belongsTo(ApiMaster::class,'api_id','id');
    }
}
