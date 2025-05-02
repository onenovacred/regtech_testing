<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    use HasFactory;
    protected $table = 'link';
    protected $fillable = ['customerid','linkname','linkheading'];
    public function customer(){
        return $this->belongsTo(consumer::class,'customerid','id');
    }
}
