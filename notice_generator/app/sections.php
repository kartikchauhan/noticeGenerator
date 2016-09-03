<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sections extends Model
{

	protected $table = 'sections';

	protected $fillable = ['notice_id','section_id'];
    
    public function noticesAlter()
    {
    	return $this->belongsTo('App\noticesAlter');
    }

    public function sectionsAvailable()
    {
    	return $this->belongsTo('App\sectionsAvailable');
    }
}
