<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\consumer;

class rulesdefined extends Model
{
    use HasFactory;
    protected $table = 'rulesdefined';
    protected $fillable = ['score','loanamount','rulesdefinedheading'];
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
