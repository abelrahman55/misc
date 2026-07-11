<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageHospital extends Model
{
    public $fillable = ['price', 'title'];
    public $casts    = [
        'title' => 'array',
        'price' => 'float',
    ];
    public function getTranslatedTitle($local = 'ar')
    {
        $lang = request()->header('lang', 'ar');
        return $this->title[$lang] ?? "";
    }

    public function optionsHospital()
    {
        return $this->belongsToMany(
            PackageHospitalOption::class,
            'related_package_hospital_options',
            'package_hospital_id',
            'package_hospital_option_id'
        );
    }
}
