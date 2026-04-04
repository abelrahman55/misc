<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMedication extends Model
{
    //
    protected $table='user_medications';
    public $fillable=[
        'user_id',
        'medication',
        'dosage',
        'frequency',
        'adverse_reactions',
        'pres_provider',
        'file_meds',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public $appends=[
        'file_meds_url',
    ];
    public function getFileMedsUrlAttribute(){
        if($this->file_meds){
            return asset('storage/'.$this->file_meds);
        }
    }
}