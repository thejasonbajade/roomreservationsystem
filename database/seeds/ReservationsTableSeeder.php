<?php

use Illuminate\Database\Seeder;
use App\Reservation;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create(array(
	        'user_id' => '123456789',
            'status' => 'Dean Approved',
            'date' => '1111-11-11',
            'start_time' => '07:00:00',
            'end_time' => '08:30:00',
            'room_id' => '1',
            'semester_id' => '1'
        ));
        Reservation::create(array(
	        'user_id' => '123456789',
            'status' => 'Dean Approved',
            'date' => '1111-11-11',
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
            'room_id' => '1',
            'semester_id' => '1'
	    ));
	    Reservation::create(array(
	        'user_id' => '123456789',
            'status' => 'Dean Approved',
            'date' => '1111-11-11',
            'start_time' => '11:30:00',
            'end_time' => '13:00:00',
            'room_id' => '1',
            'semester_id' => '1'
	    ));
	    Reservation::create(array(
	        'user_id' => '123456789',
            'status' => 'Dean Approved',
            'date' => '1111-11-11',
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
            'room_id' => '1',
            'semester_id' => '1'
	    ));
	    Reservation::create(array(
	        'user_id' => '123456789',
            'status' => 'Dean Approved',
            'date' => '1111-11-11',
            'start_time' => '14:30:00',
            'end_time' => '16:00:00',
            'room_id' => '1',
            'semester_id' => '1'
	    ));
	    Reservation::create(array(
	        'user_id' => '123456789',
            'status' => 'Dean Approved',
            'date' => '1111-11-11',
            'start_time' => '08:00:00',
            'end_time' => '10:00:00',
            'room_id' => '1',
            'semester_id' => '1'
	    ));
        Reservation::create(array(
            'user_id' => '123498765',
            'status' => 'Dean Approved',
            'date' => '2016-12-06',
            'start_time' => '08:00:00',
            'end_time' => '10:00:00',
            'room_id' => '1',
            'semester_id' => '1'
        ));
    }
}
