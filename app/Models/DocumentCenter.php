<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCenter extends Model
{
    protected $table = 'document_centers';

    protected $fillable = [
        'file',
        'user_id',
    ];
    public $casts=[
        'user_id' => 'integer',
    ];
    public function patient(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
