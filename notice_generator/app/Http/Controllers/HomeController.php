<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\coursesAvailable;
use App\branchesAvailable;
use App\yearsAvailable;
use App\sectionsAvailable;

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
}
