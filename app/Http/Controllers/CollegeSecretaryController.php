<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Reservation;
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
        return view('secretary_dashboard');
    }

    public function dashboard(){

            $requests = Reservation::all();
            $data['requests'] = $requests;            
            if ($requests != "") {
                return view('secretary_dashboard', $data);
            }
            else{
                return view('secretary_dashboard');     
            }
        return redirect('/');       
    }

    public function add_teacher(Request $request){
        $result = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        echo json_encode($result);
    }

    public function set_declined(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'declined-College Secretary']);
        echo json_encode($result);
    }

    public function set_approved(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'approved-College Secretary']);
        echo json_encode($result);
    }
}
