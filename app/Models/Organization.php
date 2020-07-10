<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Organization extends Model
{
	use Sortable;
    protected $table = 'organizations';

    public $timestamps = false;

    public function phone()
    {
        return $this->hasMany('App\Models\Phone','organizations', 'organization_id');
    }

    public function location()
    {
        return $this->hasMany('App\Models\Location','organization', 'organization_id');
    }

    public function address()
    {
        return $this->hasMany('App\Models\Address', 'organizations', 'organization_id');
    }

}
