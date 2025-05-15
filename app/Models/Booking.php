<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'schedule_id',
        'service_id',
        'user_id',
        'plat',
        'phone',
        'is_batal',
    ];

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
