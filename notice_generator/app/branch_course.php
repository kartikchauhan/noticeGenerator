<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch_course extends Model
{
    protected $table = 'branch_course';

    protected $fillable = [
    'branch_id',
    'course_id'
    ];
}
