<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $guarded = array();

    public static $rules = array(
        'title' => 'required',
        'body' => 'required'
    );
}
