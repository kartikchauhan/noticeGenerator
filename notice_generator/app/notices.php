<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notices extends Model
{
    protected $table = 'notices';

    protected $fillable = [
	    'notice_subject',
	    'file',
	    'department',
    ];
}
