<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\UserNote;
use App\Models\DoctorFile;

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
    'about',
    'alcohol',
    'physical_activity',
    'dietary_preferences',
    'type',
    'heart_rate',
    'prof_img',
    'parent_id',
    'pronous',
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
    'country_id',
    'active',
    'military_status',
    'occupation',
    'language',
    'home_number',
];
public $appends=['prof_img_url','rate_avg','rate_count'];
public function getProfImgUrlAttribute(){
    if($this->prof_img){
        return asset('storage/'.$this->prof_img);
    }
    return null;
}
public function features(){
    return $this->hasMany(UserFeature::class,'user_id')->select('id','title','user_id');
}
public function ratings(){
    return $this->hasMany(RateUser::class,'provider_id');
}
public function getRateAvgAttribute(){
    return $this->ratings()->avg('rate')*1??0;
}
public function getRateCountAttribute(){
    return $this->ratings()->count();
}
public function country(){
    return $this->belongsTo(Countries::class,'country_id');
}
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
    public function specialist(){
        return $this->belongsTo(Specialty::class,'specialization_id');
    }
    public function usernotes(){
      return $this->hasMany(UserNote::class,'user_id')??[];
    }
    public function files(){
      return $this->hasMany(DoctorFile::class);
    }
    public function rates(){
        return $this->hasMany(RateUser::class,'user_id');
    }


    // public function getSpecialistAttribute(){
    //     return $this->specialist()->first();
    // }
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