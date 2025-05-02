<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemoUserSchemeMaster extends Model
{
    use HasFactory;
    protected $table = "demo_scheme_master";

    protected $fillable = ['user_id', 'api_id', 'scheme_price','api_group_id','user_type'];

    public function api_master(){
        return $this->belongsTo(ApiMaster::class,'api_id','id');
    }
}
