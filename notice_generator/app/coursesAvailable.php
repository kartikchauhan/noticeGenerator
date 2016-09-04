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

    public function noticesAlter()
    {
        // Actual relationship is on to many, problem in making pivot table for one to many relationship
        return $this->belongsToMany('App\noticesAlter', 'coursesavailable_noticesalter', 'course_id', 'notice_id')
        ->withTimestamps(); 
    }

    public function Branches()
    {
        return $this->belongsToMany('App\coursesAvailable', 'branch_course', 'course_id', 'branch_id');
    }

    public static function getCourses()
    {
    	return DB::table('coursesavailable')
    			->get();
    }

}
