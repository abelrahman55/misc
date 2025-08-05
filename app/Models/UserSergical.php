<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSergical extends Model
{
    //
    public $table="user_surgicals";
    protected $fillable = [
        'user_id',
        'current_treatment',
        'start_date',
        'duration',
        'past_procedures',
        'surg_date',
        'surgeon',
        'outcomes',
        'reason_for_referral',
        'recommendation',
        'file_surgery',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public $appends=[
        'file_surgery_url'
    ];

    public function getFileSurgeryUrlAttribute(){
        if($this->file_surgery){
            return asset('storage/'.$this->file_surgery);
        }
    }

}
