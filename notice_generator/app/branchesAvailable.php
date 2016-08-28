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

    public static function getBranches()
    {
    	return DB::table('branchesavailable')
    			->get();
    }
}
