<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentFile extends Model
{
    //
    public $fillable=[
        'appointment_id',
        'file'
    ];
    public $appends=['file_url'];
    public function getFileUrlAttribute(){
        if($this->file){
            return asset('storage/'.$this->file);
        }
        return '';
    }
    public function appointment(){
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
}
