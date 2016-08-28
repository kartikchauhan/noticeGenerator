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

    public static function getYears()
    {
    	return DB::table('yearsavailable')
    			->get();
    }    
}
