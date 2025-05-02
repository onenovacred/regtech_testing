<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SchemeTypeMaster extends Model
{
    use HasFactory;
    protected $table = "scheme_types";
    public function users(){
        return $this->belongsTo(User::class,'id','scheme_type_id');
    }
}
