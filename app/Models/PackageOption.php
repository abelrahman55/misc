<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageOption extends Model
{
    public $fillable=['title'];
        public $casts=[
        'title'=>'array',
    ];
    public function pacakes(){
        return $this->hasMany(RelatedPackageOption::class,'package_option_id');
    }

    //
}
