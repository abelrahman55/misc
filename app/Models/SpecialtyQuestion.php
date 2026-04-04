<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialtyQuestion extends Model
{
    public $timestamps = false;
    public $table = 'specialty_questions';
    protected $fillable = [
        'question',
        'answer',
        'status',
    ];

    protected $casts = [
        'question' => 'array',
        'answer' => 'array',
    ];



    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
