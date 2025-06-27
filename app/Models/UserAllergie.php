<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAllergie extends Model
{
    //
    protected $fillable = [
    'user_id',
    'specific_drug',
    'reaction_details',
    'infor_environment',
    'specific_food',
    'insur_address',
    'insur_policy',
    'insur_coverage',
    'bill_street_name',
    'bill_town',
    'bill_number',
    'preferred_payment',
];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public $appends = [
        'file_surgery_url',
        'file_meds_url',
        'file_test_url',
        'file_imaging_url',
    ];

    public function getFileSurgeryUrlAttribute(){
        if($this->file_surgery){
            return asset('storage/'.$this->file_surgery);
        }
    }

    public function getFileMedsUrlAttribute(){
        if($this->file_meds){
            return asset('storage/'.$this->file_meds);
        }
    }

    public function getFileTestUrlAttribute(){
        if($this->file_test){
            return asset('storage/'.$this->file_test);
        }
    }

    public function getFileImagingUrlAttribute(){
        if($this->file_imaging){
            return asset('storage/'.$this->file_imaging);
        }
    }

}