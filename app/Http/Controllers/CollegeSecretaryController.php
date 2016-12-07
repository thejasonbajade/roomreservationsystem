<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Reservation;
use App\Semester;
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

            $requests = Reservation::where('date', '!=', '1111-11-11' )->get();
            $data['requests'] = $requests;            
            if ($requests != "") {
                return view('secretary_dashboard', $data);
            }
            else{
                $data['requests'] = ''; 
                return view('secretary_dashboard', $data);     
            }
        return redirect('/');       
    }

    public function add_teacher(Request $request){
        $result = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'user_type' => 'Teacher'
        ]);
        echo json_encode($result);
    }

    public function setYear(Request $request){
        $year = $request->input('ayID');
        session(['year' => $year]);
        $sem = Semester::where('start_year', '=', $year )->get()->first()->id;

        session(['sem' => $sem]);
        return \Redirect::back();
    }

    public function setSemester(Request $request){
        $id = $request->input('semID');

        if($request->input('prevSem')!=''){
            $prevID = $request->input('prevSem');
            Semester::where('id', $prevID)
                       ->update(['status' => 'Not Active']);
        }

        Semester::where('id', $id)
                       ->update(['status' => 'Active']);
        return \Redirect::back();
    }

    public function set_declined(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'declined-College Secretary']);
        echo json_encode('declined-College Secretary');
    }

    public function set_approved(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'approved-College Secretary']);
        echo json_encode('approved-College Secretary');
    }
}
