<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\noticesAlter;

class HomeController extends Controller
{
 	public function homepage()
 	{
 		try
 		{
	 		$notices = noticesAlter::orderby('created_at', 'desc')->get();

	 		$noticesAndFilesArray = [];

	 		foreach($notices as $notice)
	 		{
	 			$temp = [];
	 			array_push($temp, $notice);

	 			$getFiles = $notice->Files()->get();
	 			array_push($temp, $getFiles);

	 			array_push($noticesAndFilesArray, $temp);
	 		}

	 		return view('welcome', compact(array('noticesAndFilesArray')));
 			
 		}
 		catch(Exxception $e)
 		{
 			return redirect()->back()->withErrors('Something went wrong.');
 		}
 	}
}
