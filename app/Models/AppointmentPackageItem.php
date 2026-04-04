<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentPackageItem extends Model
{
    protected $fillable = [
        'appointment_package_id',
        'package_option_id',
    ];

    public function package()
    {
        return $this->belongsTo(AppointmentPackage::class, 'appointment_package_id');
    }

    public function option()
    {
        return $this->belongsTo(PackageOption::class, 'package_option_id');
    }
}
