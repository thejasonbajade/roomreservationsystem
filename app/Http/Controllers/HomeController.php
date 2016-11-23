<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\RoomReservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function reserveRoom() {
        $reservation = new Reservation();
        $reservation->user_id = Auth()->id();
        $reservation->save();

        $roomReservation = new RoomReservation();
        $roomReservation->reservation_id = $reservation->id;
        $roomReservation->room_id = (Input::get('room_id'));
        $roomReservation->status = "Pending";
        $roomReservation->date = (Input::get('date'));
        $roomReservation->start_time = (Input::get('start_id'));
        $roomReservation->end_time = (Input::get('end_id'));

        return view('home');
    }
}
