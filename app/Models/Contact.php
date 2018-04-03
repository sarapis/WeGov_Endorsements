<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
	use Sortable;

    protected $table = 'contacts';

    public $timestamps = false;

    public function organizations()
    {
        return $this->belongsTo('App\Models\Organization', 'organization', 'organization_id');
    }

    public function phonenumber()
    {
        return $this->hasMany('App\Models\Phone','contacts', 'contact_id');
    }

    public function service()
    {
        return $this->hasMany('App\Models\Service','contacts', 'contact_id');
    }
}
