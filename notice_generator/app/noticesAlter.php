<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class noticesAlter extends Model
{
    protected $table = 'noticesalter';

    protected $fillable = [
    	'notice_subject',
    	'filename',
    	'additional_details', 
    	];

    	public function Files()
    	{
    		return $this->hasMany('App\files');
    	}

        public function Courses()
        {
            // Notices have one to many relationship with courses. Many to many relationship has been implemented because pivot table couldn't be created for it.
            return $this->belongsToMany('App\coursesAvailable', 'coursesavailable_noticesalter', 'notice_id', 'course_id')
            ->withTimestamps(); 
        }   

        public function Branches()
        {
            // Notices have one to many relationship with courses. Many to many relationship has been implemented because pivot table couldn't be created for it.
            return $this->belongsToMany('App\branchesAvailable', 'branchesavailable_noticesalter', 'notice_id', 'branch_id')
            ->withTimestamps(); 
        }   

        public function Years()
        {
            // Notices have one to many relationship with courses. Many to many relationship has been implemented because pivot table couldn't be created for it.
            return $this->belongsToMany('App\yearsAvailable', 'yearsavailable_noticesalter', 'notice_id', 'year_id')
            ->withTimestamps(); 
        }   

        public function Sections()
        {
            // Notices have one to many relationship with courses. Many to many relationship has been implemented because pivot table couldn't be created for it.
            return $this->belongsToMany('App\sectionsAvailable', 'sectionsavailable_noticesalter', 'notice_id', 'section_id')
            ->withTimestamps(); 
        }   

    	
}
