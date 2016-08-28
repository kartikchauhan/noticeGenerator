<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class coursesAvailable extends Model
{
	protected $table = 'coursesavailable';

    protected $fillable = [
    	'course',
    ];

    public static function getCourses()
    {
    	return DB::table('coursesavailable')
    			->get();
    }


}
