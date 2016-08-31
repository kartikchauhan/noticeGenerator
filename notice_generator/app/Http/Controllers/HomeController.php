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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use \File;

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

    public function uploadImages(Request $request)
    {
        $file = $request->file;
        if(File::isFile($file))
        {
            $file = 'uploads/Basic_English_Usage_[Oxford].pdf';
            $headers = array('Content-type: application/pdf');
            return Response::download($file, 'Basic_English_Usage_[Oxford].pdf', $headers);
        }
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
        
    }

}
