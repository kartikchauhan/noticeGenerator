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

    public function noticesAlter()
    {
        // Actual relationship is on to many, problem in making pivot table for one to many relationship
        return $this->belongsToMany('App\noticesAlter', 'sectionsavailable_noticesalter', 'section_id', 'notice_id')
        ->withTimestamps(); 
    }

    public static function getSections()
    {
    	return DB::table('sectionsavailable')
    			->get();
    }    
}
