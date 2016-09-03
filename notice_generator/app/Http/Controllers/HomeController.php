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
        try
        {
            $courses = coursesAvailable::getCourses();
            $branches = branchesAvailable::getBranches();
            $years = yearsAvailable::getYears();
            $sections = sectionsAvailable::getSections();
            return view('home', compact(array('courses', 'branches', 'years', 'sections')));    
        }
        catch(Exception $e)
        {
            return ("something went wrong");
        }
        
    }

    public function createNotice(Request $request)
    {     
        $json = [];

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

            $json['message'] = 'added successfully';

         }   

        catch(Exception $e)
        {
            return "something went wrong";
        }

        return response()->json($json);

        // $files = Input::file('file');

        // if($files[0] !='')
        // {
        //     foreach($files as $file)
        //     {
        //         $addFile = new files();
        //         $addFile->notice_id = $notice->id;
        //         $addFile->filename = $file->getClientOriginalName();
        //         $file->move('uploads', $file->getClientOriginalName());
        //         $addFile->save();
        //     }
        // }

        // $courses = $request->courses;
        // if($courses[0]!='')
        // {
        //     foreach($courses as $course)
        //     {
        //         $addCourse = new courses();
        //         $course_id = coursesAvailable::find($course);
        //         $addCourse->notice_id = $notice->id;
        //         $addCourse->course_id = $course_id->id;
        //         $addCourse->save();
        //     }
        // }


        // $branches = $request->branches;
        // if($branches[0]!='')
        // {
        //     foreach($branches as $branch)
        //     {
        //         $addBranch = new branches();
        //         $addBranch->notice_id = $notice->id;
        //         $addBranch->branch_id = $branch;
        //         $addBranch->save();
        //     }
        // }

        // $years = $request->years;
        // if($years[0]!='')
        // {
        //     foreach($years as $year)
        //     {
        //         $addYear = new years();
        //         $addYear->notice_id = $notice->id;
        //         $addYear->year_id = $year;
        //         $addYear->save();
        //     }
        // }

        // $sections = $request->sections;
        // if($sections[0]!='')
        // {
        //     foreach($sections as $section)
        //     {
        //         $addSection = new sections();
        //         $addSection->notice_id = $notice->id;
        //         $addSection->section_id = $section;
        //         $addSection->save();
        //     }
        // }

    }


}
        // $files = Input::file('file');                           
        // {
        //     $notice_subject = $request->subject;
        //     $additional_details = $request->additional_details;
        //     foreach($files as $file)
        //     {   
        //         $notice = new noticesAlter();
        //         $notice->notice_subject = $notice_subject;
        //         $notice->additional_details = $additional_details;
        //         $notice->filename = $file->getClientOriginalName();                
        //         $file->move('uploads', $file->getClientOriginalName());
        //         $notice->save();

        //     }
        // }
    // }

    // public function uploadImages(Request $request)
    // {
       
    //     $files = Input::file('file');                           
    //     {
    //         $notice_subject = $request->subject;
    //         $additional_details = $request->additional_details;
    //         foreach($files as $file)
    //         {   
    //             $notice = new noticesAlter();
    //             $notice->notice_subject = $notice_subject;
    //             $notice->additional_details = $additional_details;
    //             $notice->filename = $file->getClientOriginalName();                
    //             $file->move('uploads', $file->getClientOriginalName());
    //             $notice->save();

    //         }
    //     }
        // if(File::isFile($file))
        // {
        //     // $file = 'uploads/Basic_English_Usage_[Oxford].pdf';
        //     // $headers = array('Content-type: application/pdf');
        //     // return Response::download($file, 'Basic_English_Usage_[Oxford].pdf', $headers);
        // }
        // try
        // {
        //     $this->validate($request,[
        //         'subject'=>'required',
        //         'file'=>'required'
        //         ]);
        //     $notice = new noticesAlter();      
        //     $file = $request->file;
        //     if(file_exists($file))                  
        //     {
        //         $contents = file_get_contents($file);

        //         return Response::make($content, 200, array('content-type'=>'application/pdf'));
        //     }
        //     // if($request->hasFile('file'))
        //     // {
                
        //     //     $file = Input::file('file');
        //     //     $notice->filename = $file->getClientOriginalName();
        //     //     $file->move('uploads', $notice->file);                
        //     // }
        //     // else
        //     // {
        //     //     return Redirect::back()->with('message','Upload A file');
        //     // }

        //     $notice->notice_subject = $request->subject;
        //     $notice->additional_details = $request->additional_details;
        //     $notice->save();
        //     return "file added successfully";
        // }
        // catch(Exception $e)
        // {
        //     return ("something went wrong");
        // }
        
    // }


