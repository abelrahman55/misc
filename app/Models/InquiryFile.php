<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryFile extends Model
{

    public $table='inquiry_files';

    public $fillable=['inquiry_id','file'];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class,'inquiry_id','id');
    }

}
