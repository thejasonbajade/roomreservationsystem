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

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/home');
        }

        $requests = Reservation::where('date', '!=', '1111-11-11' )->get();
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

    public function set_declined(Request $request, $id) {

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/home');
        }
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'declined-College Secretary']);
        echo json_encode($result);
    }

    public function set_approved(Request $request, $id){

        if(Auth()->user()->user_type != 'College Secretary') {
            return redirect('/');
        }

        $result = Reservation::where('id', $id)
                       ->update(['status' => 'approved-College Secretary']);
        echo json_encode($result);
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
