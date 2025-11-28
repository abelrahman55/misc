<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageMessage extends Model
{
    //

    public $fillable = ['message', 'book_package_id', 'user_id', 'file'];

    public $casts = [
        'book_package_id' => 'int',
    ];

    public function book_package()
    {
        return $this->belongsTo(BookingProvider::class, 'book_package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
