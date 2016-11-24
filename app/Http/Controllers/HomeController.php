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
        $data = [
            'reservation' => $reservation,
        ];
        return response()->json($data);
    }

    public function processEditReservation($reservationID) {
        $reservation = Reservation::find($reservationID);
        $reservation->room_id = Input::get('roomID');
        $reservation->date = Input::get('date');
        $reservation->start_time = Input::get('startTime');
        $reservation->end_time = Input::get('endTime');
        $reservation->timestamps = false;
        $reservation->save();
        return redirect('/home');
    }

    public function checkReservationConflict(Request $request) {
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $checkReservation = Reservation::where(
            'room_id', '=', $request->input('roomID'))
            ->where('date', '=', $request->input('date'))
            ->whereBetween('start_time', array($request->input('startTime')-1, $request->input('endTime')-1))
            ->orWhereBetween('end_time', array($request->input('startTime')-1, $request->input('endTime')-1))
            ->orwhere( function ($query) use ($startTime, $endTime) {
                    $query->where('start_time', '<', $startTime)
                        ->where('end_time','>', $startTime);
                }
            )
            ->count();

        $conflict = false;
        if(!$checkReservation==0) {
            $conflict = true;
        }
        $response = array(
            'conflict' => $conflict
        );
        return response()->json(['conflict'=> $conflict]);
    }
}
