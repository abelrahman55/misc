<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Town extends Model
{
    use  HasTranslations;

    protected $fillable = [
        'name',
        'country_id',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public $translatable = ['name'];

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'town_id');
    }
}
