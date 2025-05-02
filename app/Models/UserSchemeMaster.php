<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSchemeMaster extends Model
{
    use HasFactory;
    protected $table = "user_scheme_master";

    protected $fillable = ['user_id', 'api_id', 'api_group_id', 'scheme_price','plan', 'plan_amount', 'custom_plan', 'payment_slab', 'total_transaction_amount_per_api', 'duration', 'start_date', 'end_date','permission','request_permission'];

    public function api_master(){
        return $this->belongsTo(ApiMaster::class,'api_id','id');
    }
}
