<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentPackage extends Model
{
    protected $fillable = [
        'appointment_id',
        'client_id',
        'admin_id',
        'provider_id',
        'title',
        'price',
        'status',
        'rejection_reason',
    ];

    protected $casts = [
        'title' => 'array',
        'price' => 'float',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function options()
    {
        return $this->belongsToMany(PackageOption::class, 'appointment_package_items', 'appointment_package_id', 'package_option_id');
    }

    public function manualItems()
    {
        return $this->hasMany(AppointmentPackageManualItem::class, 'appointment_package_id');
    }
}
