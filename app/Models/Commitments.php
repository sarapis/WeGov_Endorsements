<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commitments extends Model
{
    protected $table = 'commitments';

    public $timestamps = false;

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency', 'managingagency', 'agency_recordid');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'projectid', 'project_recordid');
    }

}
