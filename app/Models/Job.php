<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';


    public $timestamps = false;

    public function magency()
    {
        return $this->hasMany('App\Models\Agency', 'magency', 'organization_code');
    }

}
