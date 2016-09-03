<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class years extends Model
{

	protected $table = 'years';

	protected $fillable = ['notice_id','year_id'];

    public function noticesAlter()
    {
    	return $this->belongsTo('App\noticesAlter');
    }

    public function yearsAvailable()
    {
    	return $this->belongsTo('App\yearsAvailable');
    }
}
