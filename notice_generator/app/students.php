<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class students extends Model
{
	protected $table = 'students';

    public static function getNames($str)
    {
    	return DB::table('students')
    			->select('name')
    			->where('name','LIKE',$str.'%')
    			->first();
    }
}
