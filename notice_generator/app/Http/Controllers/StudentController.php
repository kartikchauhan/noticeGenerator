<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\coursesAvailable;
use App\branchesAvailable;
use App\yearsAvailable;
use App\sectionsAvailable;
use App\Student;

use App\Http\Requests\StoreRegisteredStudents;
use App\Http\Requests\AuthenticateStudents;

class StudentController extends Controller
{
    //  public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function showLoginForm()
    {
    	return view('student.login');
    }

    public function login(AuthenticateStudents $request)
    {        
        $student_no = $request->student_no;
        $password = $request->password;
    	$checkStudent = Student::where('student_no', $student_no)->exists(); // checking whether the student_no exists or not
    	if($checkStudent)
    	{
    		$matchPassword = ['student_no' => $student_no, 'password' => $password]; 
    		$checkpassword = Student::where($matchPassword)->exists(); // checking whether student_no and password matches in the database or not
    		if($checkpassword)
    		{
    			dd('user exists');
    		}
    		else
    		{
                Session::flash('incorrectPassword', 'Incorrect Password');    			
    		}
    	}
    	else
    	{                        
            Session::flash('incorrectStudentNo', 'Student Number not found');
        }
    	
    	return Redirect()->back()->withInput();
    	

    }

    public function showRegistrationForm()
    {
		$courses = coursesAvailable::getCourses();
        $branches = branchesAvailable::getBranches();
        $years = yearsAvailable::getYears();
        $sections = sectionsAvailable::getSections();  
    	return view('student.register', compact(array('courses', 'branches', 'years', 'sections')));
    }

    public function register(StoreRegisteredStudents $request)
    {
    	$json = [];
    	try
    	{
    		$student = new Student();
	    	$student->name = $request->name;
	    	$student->student_no = $request->student_no;
	    	$student->email = $request->email;
	    	$student->course = $request->course;
	    	$student->branch = $request->branch;
	    	$student->year = $request->year;
	    	$student->section = $request->section;
	    	$student->password = $request->password; // storing text in plain form because bcrypt was encrypting password with new value every time
	    	$student->save();	    	
	    	return redirect('student/login');
    	}
    	catch(Exception $e)
    	{
    		return redirect()->back()->withErrors("Something went wrong. Please try again.");
    	}

    }
}
