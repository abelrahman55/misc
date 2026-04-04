<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackReview extends Model
{
    protected $table = 'feedback_reviews';

    protected $fillable = [
        'description',
        'user_id',
    ];
    public $casts=[
        'user_id' => 'integer',
    ];
    public function patient(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
