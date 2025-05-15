<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'tanggal',
        'status',
        'is_libur'
    ];

    public function booking(){
        return $this->hasMany(Booking::class);
    }
}
