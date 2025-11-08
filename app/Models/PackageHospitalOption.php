<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageHospitalOption extends Model
{
     public $fillable=['title'];
        public $casts=[
        'title'=>'array',
    ];
    public function pacakesHospital(){
        return $this->hasMany(RelatedPackageHospitalOption::class,'package_hospital_option_id');
    }
}
