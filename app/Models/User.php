<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable,HasRoles;
public $fillable = [
    'f_name',
    'm_name',
    'l_name',
    'relationship',
    'code',
    'phone',
    'allergies',
    'medications',
    'dnr',
    'doctor_time',
    'doctor_date',
    'organ_donation',
    'p_f_name',
    'p_m_name',
    'p_l_name',
    'p_phone',
    'p_email',
    'p_home',
    'chro_ill_conditions',
    'surgical_history',
    'family_history',
    // 'immunizations', // commented out in migration
    'smoking',
    'alcohol',
    'physical_activity',
    'dietary_preferences',
    'heart_rate',
    'specialization_id',
    'complaints',
    'blood_pressure',
    'temperature',
    'respiratory_rate',
    'oxygen_saturation',
    'height',
    'weight',
    'waist_circumference',
    'full_name',
    'prefered_hospital',
    'prefered_clinic',
    'prefered_specialist',
    'email',
    'password',
    'role',
    'gender',
    'street_name',
    'mobile_number',
    'town',
    'country',
    'military_status',
    'occupation',
    'language',
    'home_number',
];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'specialization_id' => 'integer',
        ];
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
