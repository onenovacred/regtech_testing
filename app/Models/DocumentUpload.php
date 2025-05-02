<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentUpload extends Model
{
    use HasFactory;
    protected $table = 'document_uploads';

    // protected $casts = [
    //     'id' => 'integer',
    // ];

    protected $fillable = [
         'user_id',
         'pancard_document',
         'bank_document',
	     'aadharcard_document',
	     'other_document'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
