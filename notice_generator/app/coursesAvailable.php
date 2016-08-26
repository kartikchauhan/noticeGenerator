<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coursesAvailable extends Model
{
	protected $table = 'coursesavailable';

    protected $fillable = [
    	'course',
    ];
}
