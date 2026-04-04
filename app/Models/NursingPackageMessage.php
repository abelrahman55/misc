<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NursingPackageMessage extends Model
{
    //
    public $fillable = ['message', 'book_package_id', 'user_id', 'user_type', 'file'];

    public $casts = [
        'book_package_id' => 'int',
    ];

    public function book_package()
    {
        return $this->belongsTo(BookingNursingProvider::class, 'book_package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
