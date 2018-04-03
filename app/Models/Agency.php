<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agencies';
    public $timestamps = false;

    public function commit()
    {
        return $this->hasMany('App\Models\Commitments', 'managingagency', 'agency_recordid');
    }

    public function project()
    {
        return $this->hasMany('App\Models\Project', 'project_projectid', 'agency_recordid');
    }

    public function expense()
    {
        return $this->hasMany('App\Models\Expense', 'expenses_id', 'agency_recordid');
    }

}
