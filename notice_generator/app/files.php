<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';

    protected $fillable = ['notice_id', 'filename'];

    public function noticesAlter()
    {
    	return $this->belongsTo('App\noticesAlter', 'notice_id', 'id');
    }
}
