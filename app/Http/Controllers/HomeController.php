<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use App\RoomReservation;
use App\Semester;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
        $userType = User::find($user_id)->user_type;
        if($userType == "Teacher") {
            return redirect('/teacher');
        } else if ($userType == "College Secretary") {
            return redirect('/collegeSecretary');
        } else {
            return redirect('/dean');
        }
    }
}
