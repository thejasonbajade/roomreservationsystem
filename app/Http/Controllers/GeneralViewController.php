<?php

namespace App\Http\Controllers;
use App\RoomReservation;
use App\Reservation;
use App\Room;
use App\User;
use App\Day;
use App\Semester;
// namespace Carbon\Carbon;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;
use DatePeriod;

class GeneralViewController extends Controller
{
    public function index(){
        $rooms =  Room::all();
    	$basementRooms = Room::where('level', '=', 'Basement')->get();
        $firstFloorRooms = Room::where('level', '=', '1st Floor')->get();
        $secondFloorRooms = Room::where('level', '=', '2nd Floor')->get();
        $data = array (
            'rooms' => $rooms,
            'basement' => $basementRooms,
            'firstFloor' => $firstFloorRooms,
            'secondFloor' => $secondFloorRooms
        );
        // echo "<pre>";
        // print_r($data);
        // exit();
        return view('landingpage', $data);
	}

	public function getTodaySchedule($roomID){
        date_default_timezone_set('Asia/Singapore');
        $nameOfDay =  date("l");
        $date = date('Y-m-d');
        $semeterID = Semester::where('status', '=', 'Active')->get()[0]->id;
        function getRegclass($nameOfDay, $roomID, $semeterID){
            $date = '1111-11-11';
            $days = Day::where('day', $nameOfDay)->get();
            echo "<pre>";
            print_r($days);
            $classes = array();
            foreach ($days as $day) {
                $class = Reservation::where('room_id', '=', $roomID)
                    ->where('date', '=', '1111-11-11')
                    ->where('semester_id', '=', $semeterID)
                    ->where('id', '=', $day->reservation_id)
                    ->get();
                $classes[] = $class;
            }
            // print_r($classes); //this return an array of data! $classes[0]->id blabla
            
            return $classes;
        }
        function getReservation($roomID, $date, $semeterID){
            $reservation = Reservation::where('room_id', '=', $roomID)
                    ->where('date', '=', $date)
                    ->where('semester_id', '=', $semeterID)
                    ->get();
            // echo "<pre>";
            return $reservation;
        }
       
       $regClass = getRegclass($nameOfDay, $roomID, $semeterID);
       $reservations = getReservation($roomID, $date, $semeterID);
        
        $data = array (
            'regClass' => $regClass,
            'reservations' => $reservations
        );
        echo "<pre>";
        print_r($data);
        exit();

        

	}


}
