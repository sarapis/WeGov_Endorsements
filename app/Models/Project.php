<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
	use Sortable;

    protected $table = 'projects';

    public $timestamps = false;

    public function commitments()
    {
        return $this->hasMany('App\Models\Commitments', 'projectid', 'project_recordid');
    }

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency', 'project_managingagency', 'agency_recordid');
    }

}
