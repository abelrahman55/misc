<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentPackageManualItem extends Model
{
    protected $table = 'appointment_package_manual_items';

    protected $fillable = [
        'appointment_package_id',
        'title',
    ];

    public function package()
    {
        return $this->belongsTo(AppointmentPackage::class, 'appointment_package_id');
    }
}
