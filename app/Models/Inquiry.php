<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    public $table = 'inquiries';

    public $fillable = ['user_id', 'date', 'treatment_type', 'assigned_coordintor', 'status',
        "name", "contact_details", "country_id", "specialty_id", "proximity", "reputation", "budget", "symptoms"];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(InquiryFile::class, 'inquiry_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id', 'id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id', 'id');
    }

}
