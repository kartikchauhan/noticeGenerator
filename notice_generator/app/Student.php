<?php

namespace App;

use DB;

use Illuminate\Foundation\Auth\User as Authenticatable;

// code before multiAuth
// use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'students';
    
    protected $fillable = [
        'name', 'email', 'student_no', 'course', 'branch', 'year', 'section', 'password', 'department',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   
    public static function getStudentRecord($student_no)
    {
        return DB::table('students')
                ->where('student_no', $student_no)
                ->first();
    }

}
