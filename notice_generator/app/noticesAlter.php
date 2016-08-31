<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class noticesAlter extends Model
{
    protected $table = 'noticesalter';

    protected $fillable = [
    	'notice_subject',
    	'filename',
    	'additional_details',
    	];
}
