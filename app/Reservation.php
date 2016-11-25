<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    public function rooms(){
        return $this->hasMany('App\RoomReservation', 'reservation_id','id');
    }

    public function teacher(){
        return $this->hasMany('App\User', 'user_id','id');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
