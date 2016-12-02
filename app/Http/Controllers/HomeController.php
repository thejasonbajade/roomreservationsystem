<?php

namespace App\Http\Controllers;

use App\Day;
use App\Reservation;
use App\Room;
use App\RoomReservation;
use App\Semester;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

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
        $semeterID = Semester::where('status', '=', 'Active')->get()[0]->id;
        for ($i=0; $i < count(Input::get('roomID')); $i++) {
            $reservation = new Reservation();
            $reservation->user_id = Auth()->id();
            $reservation->status = "Pending";
            $reservation->room_id = Input::get('roomID')[$i];
            $reservation->date = Input::get('date')[$i];
            $reservation->start_time = Input::get('startTime')[$i];
            $reservation->end_time = Input::get('endTime')[$i];
            $reservation->semester_id = $semeterID;
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
        $semeterID = Semester::where('status', '=', 'Active')->get()[0]->id;
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $date = $request->input('date');
        $startTimeNew = (new DateTime("$date $startTime"))->modify('+1 minute')->format('H:i:s');
        $endTimeNew = (new DateTime("$date $endTime"))->modify('-1 minute')->format('H:i:s');
        $day = date('l', strtotime($date));

        $conflict = false;

        $checkRegularClass = Reservation::where('room_id', '=', $request->input('roomID'))
            ->where('date', '=', '1111-11-11')
            ->where('semester_id', '=', $semeterID)
            ->where(function ($query) use ($startTime, $endTime, $startTimeNew, $endTimeNew) {
                $query->where(function ($query1) use ($startTimeNew, $endTimeNew){
                    $query1->whereBetween('start_time', array($startTimeNew, $endTimeNew))
                        ->orWhereBetween('end_time', array($startTimeNew, $endTimeNew));
                })->orwhere( function ($query2) use ($startTime, $endTime) {
                    $query2->where('start_time', '<=', $startTime)
                        ->where('end_time','>=', $endTime);
                }
                );
            })
            ->whereExists(function($query) use ($day){
                $query->select(DB::raw(1))
                    ->from('days')
                    ->where('day', '=', $day)
                    ->whereRaw('days.reservation_id = reservations.id');
            })
            ->get();

        if(!count($checkRegularClass)==0) {
            $conflict = true;
            return response()->json(['conflict'=> $conflict, 'reservation' => $checkRegularClass]);
        }

        $checkReservation = Reservation::where('room_id', '=', $request->input('roomID'))
            ->where('date', '=', $date)
            ->where(function ($query) use ($startTime, $endTime, $startTimeNew, $endTimeNew) {
                $query->where(function ($query1) use ($startTimeNew, $endTimeNew){
                    $query1->whereBetween('start_time', array($startTimeNew, $endTimeNew))
                        ->orWhereBetween('end_time', array($startTimeNew, $endTimeNew));
                })->orwhere( function ($query2) use ($startTime, $endTime) {
                    $query2->where('start_time', '<=', $startTime)
                        ->where('end_time','>=', $endTime);
                }
                );
            })->get();


        if(!count($checkReservation)==0) {
            $conflict = true;
        }
        return response()->json(['conflict'=> $conflict, 'reservation' => $checkReservation]);
    }
}
