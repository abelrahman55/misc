<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedPackageNursingOption extends Model
{
    public $table='related_package_nursing_options';
    public $fillable=['package_nursing_id','package_nursing_option_id'];
    public $casts=[
        'package_nursing_option_id'=>'int',
        'package_nursing_id'=>'int',
    ];
    public function packageoptionNursing(){
        return $this->belongsTo(PackageNursingOption::class,'package_nursing_option_id');
    }
    public function packageNursing(){
        return $this->belongsTo(PackageNursing::class,'package_nursing_id');
    }
}
