<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\coursesAvailable;
use App\branchesAvailable;
use App\yearsAvailable;
use App\sectionsAvailable;

use App\Notices;
use App\noticesAlter;
use App\files;

use App\courses;
use App\branches;
use App\years;
use App\sections;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
// use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // commenting out authentication method since it's creating problem for logging in
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json = [];
        try
        {
            $courses = coursesAvailable::getCourses();
            $branches = branchesAvailable::getBranches();
            $years = yearsAvailable::getYears();
            $sections = sectionsAvailable::getSections();

            $last_notice = noticesAlter::orderBy('created_at', 'desc')->first();

            $courses_for_last_notice = $last_notice->Courses()->get();   
            $branches_for_last_notice = $last_notice->Branches()->get();   
            $years_for_last_notice = $last_notice->Years()->get();   
            $sections_for_last_notice = $last_notice->sections()->get(); 

            return view('home', compact(array('courses', 'branches', 'years', 'sections', 'last_notice', 'courses_for_last_notice', 'branches_for_last_notice', 'years_for_last_notice', 'sections_for_last_notice')));    
        }
        catch(Exception $e)
        {
            return ("something went wrong");
        }
        
    }
            // code for retrieving courses starts fromm here
                //getting the last 3 records from the database
                                // $last_three_notices = noticesAlter::orderBy('created_at', 'desc')->select('id')->take(3)->get(); 
                                // dd($last_three_notices);

                                // $last_three_notices_array = $notices->toArray();
                                // $notices_ids_array = [];

                                // foreach($last_three_notices_array as $last_three_notices_index)
                                // {
                                //     array_push($notices_ids_array, $last_three_notices_index['id']);
                                // }

                                // foreach($notices_ids_array as $notices_id)
                                // {
                                //     var_dump($notices_id);

                                //     $courses_with_notice_ids = noticesAlter::find($notices_id);
                                //     $c = $courses_with_notice_ids->Courses()->get();
                                //     foreach($c as $co)
                                //     {
                                //         var_dump($co->course);
                                //     }                
                                // }            
            // code for retrieving courses ends here
            

    public function categorizeNotice(Request $request)
    {     
        $json = [];

        try
        {
            // code for ajax filters starts from here

            if($request->index == 1)
            {
                $branches = [];
                $courses = $request->courses; // get all course_ids in an array by ajax
                foreach($courses as $course) // iterate over every course_id
                {                    
                    $courseObject = coursesAvailable::find($course); // find course from it's respective id
                    $getBranches = $courseObject->Branches()->get();   // get all branches in respect to the $courseObject 
                    foreach($getBranches as $getBranch) // iterate over every branch that we got
                    {
                        $branches[$getBranch->id] = $getBranch->branch; //saving branches in form of key => value
                    }
                }

                $json['category'] = 'branches';
                $json['allValues'] = $branches; // $json['allValues'] - generalized for courses, branches, years & sections
            }

            else if($request->index == 2)
            {
                $sections = [];
                $branches = $request->branches; 
                foreach($branches as $branch) 
                {                    
                    $branchObject = branchesAvailable::find($branch); 
                    $getSections = $branchObject->Sections()->get(); 
                    foreach($getSections as $getSection)
                    {
                        $sections[$getSection->id] = $getSection->section;
                    }
                }

                $json['category'] = 'sections';
                $json['allValues'] = $sections; 
            }
            
                $json['status'] = 1; 
          
        }
        catch(Exception $e)
        {
            return "something went wrong";
        }

        return response()->json($json);

        // code for ajax filters ends here
    }

    public function saveNotice(Request $request)
    {
        try
        {

            $addNotice = new noticesAlter();
            $addNotice->notice_subject = $request->subject;
            $addNotice->additional_details = $request->additional_details;
            $addNotice->save();

            $courses = $request->courses;
            $branches = $request->branches;
            $years = $request->years;
            $sections = $request->sections;

            $notice = noticesAlter::find($addNotice->id);

            $addCourse = coursesAvailable::find($courses);
            $notice->Courses()->attach($courses);

            $addBranch = branchesAvailable::find($branches);
            $notice->Branches()->attach($branches);

            $addYear = yearsAvailable::find($years);
            $notice->Years()->attach($years);

            $addSection = sectionsAvailable::find($sections);
            $notice->sections()->attach($sections);

            $files = Input::file('file');

            if($files[0] != '')
            {
                foreach($files as $file)
                {
                    $addFile = new files(['filename' => $file->getClientOriginalName()]);
                    $file->move('uploads', $file->getClientOriginalName());
                    $notice->Files()->save($addFile);
                }
            }            

         }   

        catch(Exception $e)
        {
            return "something went wrong";
        }

        return redirect()->back()->witherrors("notice added successfully");

    }


}
       

   

