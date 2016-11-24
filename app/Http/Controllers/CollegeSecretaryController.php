<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\RoomReservation;
use Illuminate\Http\Request;

class CollegeSecretaryController extends Controller
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
        return view('collegesecretaryhome');
    }

}
