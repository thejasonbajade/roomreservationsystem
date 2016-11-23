<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use App\RoomReservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $user_id = Auth()->id();
        $reservations = User::find($user_id)->reservations;
        $rooms = Room::all();
        $data = array (
            'reservations' => $reservations,
            'rooms' => $rooms
        );
        return view('home', $data);
    }

    public function reserveRoom(Request $request) {

        for ($i=0; $i < count(Input::get('roomID')); $i++) {
            $reservation = new Reservation();
            $reservation->user_id = Auth()->id();
            $reservation->status = "Pending";
            $reservation->room_id = Input::get('roomID')[$i];
            $reservation->date = Input::get('date')[$i];
            $reservation->start_time = Input::get('startTime')[$i];
            $reservation->end_time = Input::get('endTime')[$i];
            $reservation->save();
        }
        return redirect('/home');
    }

    public function cancelReservation($reservationID) {
        $reservation = Reservation::find($reservationID);
        $reservation->delete();
        return redirect('/home');
    }

    public function editReservation($reservationID) {
        $reservation = Reservation::find($reservationID);
        $rooms = Room::all();
        $data = array(
            'reservation' => $reservation,
            'rooms' => $rooms
        );

        return view('editroom', $data);
    }

    public function processEditReservation($reservationID) {
        $reservation = Reservation::find($reservationID);
        $reservation->room_id = Input::get('roomID');
        $reservation->date = Input::get('date');
        $reservation->start_time = Input::get('startTime');
        $reservation->end_time = Input::get('endTime');
        $reservation->timestamps = false;
        $reservation->save();
        return redirect('/editReservation/'.$reservationID);
    }

    public function checkReservationConflict(Request $request) {
        echo "<script type='text/javascript'>alert('Im here');</script>";
//        $checkReservation = Reservation::where(
//            'room_id', '=', $request->input('roomID'))
//            ->where('date', '=', $request->input('date'))
//            ->whereBetween('start_time', array($request->input('startTime'), $request->input('endTime')))
//            ->orWhereBetween('end_time', array($request->input('startTime'), $request->input('endTime')))
//            ->count();

        $conflict = 'conflict';
//        if(!checkReservation=0) {
//            $conflict = true;
//        }
        $data = array(
            'conflict' => $conflict
        );
        return Response::json($data);
    }
}
