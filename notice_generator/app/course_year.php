<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_year extends Model
{
    protected $table = 'course_year';

    protected $fillable = [
    'course_id',
    'years_id'
    ];
}
