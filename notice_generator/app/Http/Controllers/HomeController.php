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

 	public function categorizeNotices(Request $request)
 	{
 		$json = [];

 		try
 		{
 			$departmentId = $request->departmentId;
 			$notices = noticesAlter::where('department_id', $departmentId)->orderBy('created_at', 'desc')->get();
			$noticesAndFilesArray = [];

			if($noticesAndFiles!=null)
			{
				$json['status'] = 2;
				return response()->json($json);
			}

			foreach($notices as $notice)
	 		{
	 			$temp = [];
	 			array_push($temp, $notice);

	 			$getFiles = $notice->Files()->get();
	 			array_push($temp, $getFiles);

	 			array_push($noticesAndFilesArray, $temp);
	 		} 			

 			if($request->departmentID!=null )
 			{
 				$json['status'] = 1;
 				$json['noticesAndFilesArray'] = $noticesAndFilesArray; 			
 				return response()->json($json);
 			}
 			else
 			{
 				return view('welcome', compact(array('noticesAndFilesArray', 'noticesAndFiles')));	
 			}

	 		// return view('welcome', compact(array('noticesAndFilesArray')));
 		}
 		catch(Exxception $e)
 		{
 			return redirect()->back()->withErrors('Something went wrong.');
 		}
 	}
}
