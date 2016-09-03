<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branches extends Model
{

	protected $table = 'branches';

	protected $fillable = ['notice_id','branch_id'];


    public function noticesAlter()
    {
    	return $this->belongsTo('App\noticesAlter', 'notice_id');
    }

    public function branchesAvailable()
    {
    	return $this->belongsTo('App\branchesAvailable', 'branch_id');
    }
}
