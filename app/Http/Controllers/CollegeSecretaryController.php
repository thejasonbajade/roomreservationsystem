<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Reservation;
use App\Semester;
use App\Division;


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
            $activeSem = Semester::where('status', '=', 'Active' )->get()->first();
            $semID = $activeSem->id;
            $year = date('Y');
            $requests = Reservation::where('date', '!=', '1111-11-11' )->where('semester_id',$semID)->get();

            $data['requests'] = $requests;            
            $data['year'] = $year;    
            $data['activeSem'] = $activeSem;  

            $divisions = Division::all();
            $data['requests'] = $requests;
            $data['divisions'] = $divisions;
            $data['teacher'] = null;

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

        if($result==1){
            $prevID = $request->input('activeSem');
            Semester::where('id', $prevID)
                       ->update(['status' => 'Not Active']);
        }

        echo json_encode($result);

    }

    public function set_declined(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'College Secretary Denied']);
        echo json_encode('College Secretary Denied');
    }

    public function set_approved(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'College Secretary Approved']);
        echo json_encode('College Secretary Approved');
    }
}
