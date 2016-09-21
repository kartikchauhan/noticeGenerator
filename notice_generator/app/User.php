<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'department',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function noticesAlter()
    {
       return $this->hasMany('App\noticesAlter', 'department_id', 'id');
    }

    public static function getStudentRecord($student_no)
    {
        return DB::table('users')
                ->where('student_no', $student_no)
                ->first();
    }
}
