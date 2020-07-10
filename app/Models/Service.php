<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public $timestamps = false;

    public function organization()
    {
        return $this->belongsTo('App\Models\ServiceOrganization', 'organization', 'organization_recordid');
    }

    public function taxonomy()
    {
        return $this->belongsTo('App\Models\Taxonomy', 'taxonomy', 'taxonomy_id');
    }
}
