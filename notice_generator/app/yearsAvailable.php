<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class yearsAvailable extends Model
{
    protected $table = 'yearsavailable';

    protected $fillable = [
    'year',
    ];
}
