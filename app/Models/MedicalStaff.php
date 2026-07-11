<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalStaff extends Model
{
    //
    public $table = 'medical_staffs';
    public $fillable = [
        'user_id',
        'name',
        'qualification',
        'experience_years',
        'specialization',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
