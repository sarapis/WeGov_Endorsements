<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Politician extends Model
{
    protected $table = 'politicians';
    public $timestamps = false;


    public function endorsement() {
        return $this->belongsTo('App\Models\Endorsement',  'candidate_name', 'recordid') ;
    }

    public function elected() {
        return $this->hasMany('App\Models\PoliticianOrganization',  'elected_to', 'recordid') ;
    }

}