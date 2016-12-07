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
            $year = date('Y');
            $requests = Reservation::where('date', '!=', '1111-11-11' )->get();

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
                       ->update(['status' => 'College Secretary Denied']);
        echo json_encode('College Secretary Denied');
    }

    public function set_approved(Request $request, $id){
        $result = Reservation::where('id', $id)
                       ->update(['status' => 'College Secretary Approved']);
        echo json_encode('College Secretary Approved');
    }
}
