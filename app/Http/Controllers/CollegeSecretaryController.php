<?php

namespace App\Http\Controllers;


use App\Day;
use App\Room;
use App\Semester;
use Illuminate\Http\Request;
use App\User;
use App\Reservation;
use App\Division;
use Illuminate\Support\Facades\Input;

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
    public function index(){

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/');
        }

        return view('secretary_dashboard');
    }

    public function dashboard(){
            $activeSem = Semester::where('status', '=', 'Active' )->get()->first();
            $semID = $activeSem->id;
            $year = date('Y');
            $requests = Reservation::where('date', '!=', '1111-11-11' )->where('semester_id',$semID)->get();
            $data['rooms'] = Room::all();
            $data['requests'] = $requests;            
            $data['year'] = $year;    
            $data['activeSem'] = $activeSem;  

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/home');
        }

        $divisions = Division::all();
        $data['requests'] = $requests;
        $data['divisions'] = $divisions;
        $data['teacher'] = null;
        if ($requests != "") {
            return view('secretary_dashboard', $data);
        }
        else{
            return view('secretary_dashboard');
        }
        return redirect('/');       
    }

    public function add_teacher(Request $request){

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/home');
        }
        $result = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'user_type' => 'Teacher',
            'division_id' => $request->input('divisionID')
        ]);

        $requests = Reservation::where('date', '!=', '1111-11-11' )->get();
        $divisions = Division::all();

        $result['password'] = $request->input('password');

        $data['requests'] = $requests;
        $data['divisions'] = $divisions;
        $data['teacher'] = $result;

        return redirect('/collegeSecretary')->with('teacher', $result);
//        echo json_encode($result);
    }

    public function set_semester(Request $request){

        $sem = $request->input('semester');
        $ay = explode(',',$request->input('year'));
        $result = Semester::where('start_year', $ay[0])
                        ->where('end_year', $ay[1])
                        ->where('semester', $sem)
                       ->update(['status' => 'Active']);
        $newID = Semester::where('start_year', $ay[0])
                        ->where('end_year', $ay[1])
                        ->where('semester', $sem)->get()->first();
        $prevID = $request->input('activeSem');

        if($result==1&&($newID->id!=$prevID)){
            Semester::where('id', $prevID)
                       ->update(['status' => 'Not Active']);
        }

        echo json_encode($result);

    }

    public function set_declined(Request $request, $id){
        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/home');
        }

        $result = Reservation::where('id', $id)
                       ->update(['status' => 'College Secretary Denied']);
        echo json_encode('College Secretary Denied');
    }

    public function set_approved(Request $request, $id){

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/');
        }

        $result = Reservation::where('id', $id)
                       ->update(['status' => 'College Secretary Approved']);
        echo json_encode('College Secretary Approved');
    }

    public function addRegularSchedule() {

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/home');
        }

        $rooms = Room::all();
        $data['rooms'] = $rooms;
        return view('add_regular_sched', $data);
    }

    public function processAddRegularSchedule(Request $request) {

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/home');
        }

        $semeterID = Semester::where('status', '=', 'Active')->get()[0]->id;
        $userID = Auth()->id();
        for($i = 0; $i < count(Input::get('startTime')); $i++) {
            $schedule = Reservation::create([
                'user_id' => $userID,
                'status' => 'Dean Approved',
                'date' => '1111-11-11',
                'start_time' => Input::get('startTime')[$i],
                'end_time' => Input::get('endTime')[$i],
                'room_id' => Input::get('roomID'),
                'semester_id' => $semeterID
            ]);
            $fieldName = 'days'.($i+1);
            foreach($request->input($fieldName) as $day) {
                $day = Day::create([
                    'reservation_id'=> $schedule->id,
                    'day'=> $day
                ]);
            }
        }

        $room = Room::find(Input::get('roomID'));
        return redirect('/collegeSecretary/add_regular_schedule')->with('room', $room );
    }
}
