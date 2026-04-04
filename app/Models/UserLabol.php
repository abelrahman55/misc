<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLabol extends Model
{
    protected $table = 'user_labo';

    //
    public $fillable=[
        'user_id',
        'test_type',
        'file_test',
        'timeline',
        'date_of_studies',
        'file_imaging',
    ];
    public $appends=['file_test_url','file_imaging_url'];
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
