<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class yearsAvailable extends Model
{
    protected $table = 'yearsavailable';

    protected $fillable = [
    'year',
    ];

    public function noticesAlter()
    {
        // Actual relationship is on to many, problem in making pivot table for one to many relationship
        return $this->belongsToMany('App\noticesAlter', 'yearsavailable_noticesalter', 'year_id', 'notice_id')
        ->withTimestamps(); 
    }

    public function Courses()
    {
        return $this->belongsToMany('App\coursesAvailable', 'branch_course', 'year_id', 'course_id');
    }

    public static function getYears()
    {
    	return DB::table('yearsavailable')
    			->get();
    }    
}
