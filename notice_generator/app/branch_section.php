<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch_section extends Model
{
    protected $table = 'branch_section';

    protected $fillable = [
    'branch_id',
    'section_id'
    ];
}
