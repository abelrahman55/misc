<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageNursing extends Model
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

    public function optionsNursing()
    {
        return $this->belongsToMany(
            PackageNursingOption::class,
            'related_package_nursing_options', // pivot table
            'package_nursing_id',              // المفتاح في جدول الوسيط
            'package_nursing_option_id'        // المفتاح الثاني في جدول الوسيط
        );
    }
}
