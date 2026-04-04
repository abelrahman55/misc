<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedPackageHospitalOption extends Model
{

     public $table='related_package_hospital_options';
    public $fillable=[
        'package_hospital_option_id',
        'package_hospital_id',
    ];
    public $casts=[
        'package_hospital_option_id'=>'int',
        'package_hospital_id'=>'int'
    ];
    public function packageoptionHospital(){
        return $this->belongsTo(PackageHospitalOption::class,'package_hospital_option_id');
    }
    public function packageHospital(){
        return $this->belongsTo(PackageHospital::class,'package_hospital_id');
    }
}
