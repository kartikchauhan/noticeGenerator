<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class branchesAvailable extends Model
{
    protected $table = 'branchesavailable';

    protected $fillable = [
    	'branch',
    ];

    public function noticesAlter()
    {
        // Actual relationship is on to many, problem in making pivot table for one to many relationship
        return $this->belongsToMany('App\noticesAlter', 'branchesavailable_noticesalter', 'branch_id', 'notice_id')
        ->withTimestamps(); 
    }

    public function  Courses()
    {
        return $this->belongsToMany('App\branchesAvailable', 'branch_course', 'branch_id', 'course_id');
    }

    public static function getBranches()
    {
    	return DB::table('branchesavailable')
    			->get();
    }


}
