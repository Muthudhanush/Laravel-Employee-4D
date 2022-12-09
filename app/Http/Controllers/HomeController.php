<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\EmployeeDetails;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Notifications\EmailNotification;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Employees = EmployeeDetails::all();
        return view('home', compact('Employees'));
    }

    public function addemployee()
    {
        return view('addemployee');
    }

    public function saveemployee(Request  $request)
    {
        $Employee = new EmployeeDetails();
            $Employee->emp_id = $request->input('emp_id');
            $Employee->emp_name = $request->input('name');
            $Employee->email = $request->input('email');
            $Employee->role = $request->input('role');
            $Employee->department = $request->input('department');
            
            $a = $Employee->save();

        return redirect('/home');
    }

    public function editemployee($id)
    {
        $Employee = EmployeeDetails::find($id);

        return view('editemployee', compact('Employee'));
    }

    public function updateEmployee(Request  $request,$id)
    {
        $Employee = EmployeeDetails::find($id);
        $Employee->Emp_Id = $request->input('emp_id');
        $Employee->Emp_Name = $request->input('name');
        $Employee->email = $request->input('email');
        $Employee->Role = $request->input('role');
        $Employee->Department = $request->input('department');
        
        $a = $Employee->save();

        return redirect('/home');
    }

    

    public function deleteEmployee($id)
    {
        $Employee = EmployeeDetails::find($id);
        $del = $Employee->delete();
        return redirect('/home');
    }

    
    public function fileExport() 
    {
        return Excel::download(new UsersExport, 'Employee-Details.xlsx');
    }  

    public function NotifyEmail($id) 
    {
    	$user = EmployeeDetails::first();

        $project = [
            'greeting' => 'Hi '.',',
            'body' => 'Email has successfully sent to you...!',
            'thanks' => 'Regards Dhanush... please use this below link to clone your project',
            'actionText'=> 'Hope you might get it soon...!',
            'actionURL' => url('/'),
            'id' => 57
        ];
  
        Notification::send($user, new EmailNotification($project));
   
        dd('Notification sent!');
    }

}
