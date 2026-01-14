<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
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

    public function options()
    {
        return $this->belongsToMany(
            PackageOption::class,
            'related_package_options', // pivot table
            'package_id',              // المفتاح في جدول الوسيط
            'package_option_id'        // المفتاح الثاني في جدول الوسيط
        );
    }
}
