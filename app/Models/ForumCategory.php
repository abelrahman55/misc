<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    //
    protected $table = 'forum_categories';
    protected $fillable = [
        'speciality_id',
        'forum_id',
    ];
    public function forum(){
        return $this->belongsTo(Forums::class,'forum_id');
    }
    public function speciality(){
        return $this->belongsTo(Specialty::class,'speciality_id');
    }
    public $casts=[
        'speciality_id' => 'integer',
        'forum_id' => 'integer',
    ];

}
