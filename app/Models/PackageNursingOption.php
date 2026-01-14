<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageNursingOption extends Model
{
        public $fillable=['title'];
        public $casts=[
        'title'=>'array',
    ];
    public function pacakesNursing(){
        return $this->hasMany(RelatedPackageNursingOption::class,'package_nursing_option_id');
    }
}
