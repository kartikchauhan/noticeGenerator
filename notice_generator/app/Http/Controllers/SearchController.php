<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Response;

use App\students;

class SearchController extends Controller
{
    public function search()
    {
    	return View('search');
    }

    public function getNames(Request $request)
    {
    	$json = [];
    	try
    	{
    		$str_val = $request->search;
    		$str = students::getNames($str_val);
    		$json['name'] = $str;
    	}
    	catch(Exception $e)
    	{
    		return "something went wrong";
    	}
    		return response()->json($json)->header('Content-type','application/json');
    }
}
