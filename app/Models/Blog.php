<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use  HasTranslations;

     public $fillable = ['title', 'description', 'image', 'status'];
    public $casts=[
        'title'=>'array',
        'description'=>'array'
    ];
    
        public $translatable = ['title','description'];

    

     public function scopeActive($query){
        return $query->where('status',1);
    }
}
