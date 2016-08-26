<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branchesAvailable extends Model
{
    protected $table = 'branchesavailable';

    protected $fillable = [
    	'branch',
    ];
}
