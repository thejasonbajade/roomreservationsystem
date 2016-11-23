<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    public function room(){
        return $this->belongsTo('App\Room');
    }

    public function teacher(){
        return $this->belongsTo('App\User');
    }
}
