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
        return view('dean_dashboard');
    }

    public function dashboard(){

            $requests = Reservation::where('date', '!=', '1111-11-11' )->get();
            $data['requests'] = $requests;            
            if ($requests != "") {
                return view('dean_dashboard', $data);
            }
            else{
                return view('dean_dashboard');     
            }
        return redirect('/');       
    }

    public function set_declined(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'Dean Declined']);
        echo json_encode('Dean Declined');
    }

    public function set_approved(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'Dean Approved']);
        echo json_encode('Dean Approved');
    }
}
