<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    protected $table = 'files';

    protected $fillable = ['filename'];

    public function noticesAlter()
    {
    	return $this->belongsTo('App\noticesAlter');
    }
}
