<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Reservation;
class DeanController extends Controller
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
        if(Auth()->user()->user_type != 'Dean') {
            return redirect('/home');
        }

        return view('dean_dashboard');
    }

    public function dashboard(){

        if(Auth()->user()->user_type != 'Dean') {
            return redirect('/home');
        }

        $requests = Reservation::where('date', '!=', '1111-11-11' )->get();
        $data['requests'] = $requests;
        if ($requests != "") {
            return view('dean_dashboard', $data);
        }
        else{
            return view('dean_dashboard');
        }
        return redirect('/home');
    }

    public function set_declined(Request $request, $id){
        if(Auth()->user()->user_type != 'Dean') {
            return redirect('/');
        }

        $result = Reservation::where('id', $id)
                       ->update(['status' => 'Dean Declined']);
        echo json_encode('Dean Declined');
    }

    public function set_approved(Request $request, $id){
        if(Auth()->user()->user_type != 'Dean') {
            return redirect('/home');
        }

        $result = Reservation::where('id', $id)
                       ->update(['status' => 'Dean Approved']);
        echo json_encode('Dean Approved');
    }
}
