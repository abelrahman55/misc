<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderMakeMeeting extends Model
{
    //
    public $table    = 'provider_meetings';
    public $fillable = [
        'offer_id',
        'user_id',
        'doctor_id',
        'meeting',
        'date',
        'ended',
        'time',
    ];
    public $casts = [
        'offer_id'  => 'int',
        'user_id'   => 'int',
        'doctor_id' => 'int',
    ];
    public function offer()
    {
        return $this->belongsTo(ProviderMakeOffer::class, 'offer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
