<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorFile extends Model
{
    //
    protected $table = 'doctor_files';

    protected $fillable = [
        'file',
        'user_id',
    ];
    public $casts=[
        'user_id' => 'integer',
    ];
    public function doctor(){
        return $this->belongsTo(User::class,'user_id');
    }
}
