<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\coursesAvailable;
use App\branchesAvailable;
use App\yearsAvailable;
use App\sectionsAvailable;
use App\Student;

use App\Http\Requests\StoreRegisteredStudents;

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

    public function login(Request $request)
    {
    	$checkStudent = Student::findorfail($request->student_no);
    	if($checkStudent)
    	{
    		$password = $checkStudent->password;
    		if($password = $request->password)
    		{
    			return view('student.home');
    		}
    		else
    		{
    			return "Login first";
    		}
    	}

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
	    	$student->password = bcrypt($request->password);
	    	$student->save();
	    	$json['message'] = "added successfully";
    	}
    	catch(Exception $e)
    	{
    		return "something went wrong";
    	}
    	return response()->json($json);
    	

    }
}
