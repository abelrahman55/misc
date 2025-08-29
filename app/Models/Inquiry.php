<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    public $table='inquiries';

    public $fillable=['user_id','date','treatment_type','assigned_coordintor','status'];

    public function patient()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function files()
    {
        return $this->hasMany(InquiryFile::class,'inquiry_id','id');
    }





}
