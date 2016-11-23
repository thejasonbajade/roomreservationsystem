<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    protected $table = 'RoomReservation';

    public function rooms(){
        return $this->hasMany('App\Room', 'room_id','id');
    }

    public function reservation() {
        return $this->belongsTo('App\Reservation');
    }
}
