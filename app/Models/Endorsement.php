<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endorsement extends Model
{
    protected $table = 'endorsements';
    public $timestamps = false;

    public function elections() {
        return $this->hasMany('App\Models\Election','recordid','election') ;
    }

    public function candidate()
    {
        return $this->hasMany('App\Models\Politician', 'recordid', 'candidate_name');
    }

    public function offices()
    {
        return $this->hasMany('App\Models\PoliticianOrganization',  'recordid', 'office');
    }

    public function organization()
    {
        return $this->hasMany('App\Models\PoliticianOrganization', 'recordid', 'organizations');
    }

}