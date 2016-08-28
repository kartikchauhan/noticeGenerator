<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class sectionsAvailable extends Model
{
    protected $table = 'sectionsavailable';

    protected $fillable = [
    'section'
    ];

    public static function getSections()
    {
    	return DB::table('sectionsavailable')
    			->get();
    }    
}
