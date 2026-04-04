<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedPackageOption extends Model
{
    //
    public $table='related_package_options';
    public $fillable=['package_id','package_option_id'];
    public $casts=[
        'package_option_id'=>'int',
        'package_id'=>'int',
    ];
    public function packageoption(){
        return $this->belongsTo(PackageOption::class,'package_option_id');
    }
    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }
}
