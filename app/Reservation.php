<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = [
        'user_id', 'status', 'date', 'start_time', 'end_time', 'room_id', 'semester_id'
    ];

    public function room(){
        return $this->belongsTo('App\Room');
    }

    public function semester() {
        return $this->belongsTo('App\Semester');
    }

    public function teacher(){
        return $this->belongsTo('App\User');
    }

    public function days() {
        return $this->hasMany('App\Days');
    }
}
