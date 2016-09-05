<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{

	protected $table = 'courses';

	protected $fillable = ['notice_id','course_id'];
	
    // public function noticesAlter()
    // {
    // 	return $this->belongsTo('App\noticesAlter', 'notice_id');
    // }

    // public function coursesAvailable()
    // {
    // 	return $this->belongsTo('App\coursesAvailable', 'course_id');
    // }


}
