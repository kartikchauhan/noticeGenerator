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
use App\User;
use App\noticesAlter;

use App\Http\Requests\StoreRegisteredStudents;
use App\Http\Requests\AuthenticateStudents;

class StudentController extends Controller
{
    public function showLoginForm()
    {
        try
        {
            if(Auth::check())
            {
                return redirect('student/dashboard');
            }
        	return view('student.login');            
        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors('Something went wrong');
        }
    }

    public function login(AuthenticateStudents $request)
    {    
        try
        {
            $student_no = $request->student_no;
            $password = $request->password;        
            if(Auth::attempt(array('student_no'=>$student_no, 'password'=>$password)))
            {
                return redirect('/student/dashboard');
            }   
            else
            {
                Session::flash('incorrectPassword', 'Wrong Credentials');
                return Redirect()->back()->withInput();            
            }            
        }    
        catch(Exception $e)
        {
            return redirect()->back()->withErrors('Something went wrong');
        }
    }

    public function dashboard()
    {
        try
        {
            if(Auth::check())
            {
                $currentStudent = Auth::User();        
                $currentStudentNumber = $currentStudent->student_no;
                $getStudentRecord = User::getStudentRecord($currentStudentNumber);   
                $name = $getStudentRecord->name;                         
                $course = $getStudentRecord->course;
                $branch = $getStudentRecord->branch;
                $year = $getStudentRecord->year;
                $section = $getStudentRecord->section;

                $noticeIdsFromCourse = [];
                $noticeIdsFromBranch = [];
                $noticeIdsFromYear = [];
                $noticeIdsFromSection = [];

                // get course details from coursesAvailable table where course = current student's course
                $getCourseName = coursesAvailable::find($course);
                // get all notice Ids in relation with current student's course                         
                $getCorrespondingNoticeIdsForCourse = $getCourseName->noticesAlter()->get();
                
                foreach($getCorrespondingNoticeIdsForCourse as $getCorrespondingNoticeIdForCourse)
                {                    
                    array_push($noticeIdsFromCourse, $getCorrespondingNoticeIdForCourse->id);
                }

                // get branch details from branchesAvailable table where branch = current student's branch
                $getBranchName = branchesAvailable::find($branch);                  
                // get all notice Ids in relation with current student's branch 
                $getCorrespondingNoticeIdsForBranch = $getBranchName->noticesAlter()->get();
                
                foreach($getCorrespondingNoticeIdsForBranch as $getCorrespondingNoticeIdForBranch)
                {                       
                    array_push($noticeIdsFromBranch, $getCorrespondingNoticeIdForBranch->id);
                }                

                $getYearName = yearsAvailable::find($year);                        
                $getCorrespondingNoticeIdsForYear = $getYearName->noticesAlter()->get();
                
                foreach($getCorrespondingNoticeIdsForYear as $getCorrespondingNoticeIdForYear)
                {                       
                    array_push($noticeIdsFromYear, $getCorrespondingNoticeIdForYear->id);
                }                

                $getSectionName = sectionsAvailable::find($section);                        
                $getCorrespondingNoticeIdsForSection = $getSectionName->noticesAlter()->get();
                
                foreach($getCorrespondingNoticeIdsForSection as $getCorrespondingNoticeIdForSection)
                {                       
                    array_push($noticeIdsFromSection, $getCorrespondingNoticeIdForSection->id);
                }

                $noticeIdsArray = [];

                // checking which array of NoticeIds has least number of values
                $leastValueArray = sizeof($noticeIdsFromCourse) > sizeof($noticeIdsFromBranch) ? $noticeIdsFromBranch : $noticeIdsFromCourse;
                $leastValueArray = sizeof($leastValueArray) > sizeof($noticeIdsFromYear) ? $noticeIdsFromYear : $leastValueArray;
                $leastValueArray = sizeof($leastValueArray) > sizeof($noticeIdsFromSection) ? $noticeIdsFromSection : $leastValueArray;                                
                
                // checking existence of every Value of $lestValueArray in other tables
                foreach($leastValueArray as $value)
                {
                    $checkValueInCourseArray = in_array($value, $noticeIdsFromCourse);
                    $checkValueInBranchArray = in_array($value, $noticeIdsFromBranch);
                    $checkValueInYearArray = in_array($value, $noticeIdsFromYear);
                    $checkValueInSectionArray = in_array($value, $noticeIdsFromSection);
                    // if the current $value(notice id) exists in every other array then we will show
                    // the notice with this notice Id to the student
                    if($checkValueInCourseArray && $checkValueInBranchArray && $checkValueInYearArray && $checkValueInSectionArray)
                    {
                        array_push($noticeIdsArray, $value);
                    }
                }                

                // reversing array $noticeIdsArray for timestamps in view (to get latest notice at top)
                $reverseNoticeIdsArray = array_reverse($noticeIdsArray);
                // code for putting arrays into arrays starts from here

                $noticesAndFilesArray = [];                    

                foreach($reverseNoticeIdsArray as $noticeId)
                {
                    $temp = [];
                    $notices = noticesAlter::find($noticeId);
                    array_push($temp, $notices);

                    $getFiles = $notices->Files()->get();
                    array_push($temp, $getFiles);

                    array_push($noticesAndFilesArray, $temp);
                }

            //  code for putting arrays into arrays ends here                                                 

            return view('student.dashboard', compact(array('name', 'noticesAndFilesArray')));
            }
            else
            {
                return redirect('/student/login');
            }
            
        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors('Something went wrong');
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
    		$student = new User();
	    	$student->name = $request->name;
	    	$student->student_no = $request->student_no;
	    	$student->email = $request->email;
	    	$student->course = $request->course;
	    	$student->branch = $request->branch;
	    	$student->year = $request->year;
	    	$student->section = $request->section;
	    	$student->password = bcrypt($request->password); // storing text in plain form because bcrypt was encrypting password with new value every time
            $student->is_admin = 0;            
	    	$student->save();	    	
	    	return redirect('student/login');
    	}
    	catch(Exception $e)
    	{
    		return redirect()->back()->withErrors("Something went wrong. Please try again.");
    	}

    }

    public function logout()
    {
        Auth::logout();
        return redirect('home');
    }
}
