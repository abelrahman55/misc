<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forums extends Model
{
    //
    public $table='forums';
    public $fillable=['content','user_id','image','title'];
    public $casts=[
        'user_id'=>'integer'
    ];
    public $appends=['image_url'];
    public function getImageUrlAttribute(){
        if($this->image){
            return asset('storage/'.$this->image);
        }
        return null;
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
public function categories() {
    return $this->belongsToMany(Specialty::class, 'forum_categories', 'forum_id', 'speciality_id');
}
}
