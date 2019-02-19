<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';
    public $timestamps = false;

    public function organization() {
        return $this->hasMany('App\Models\PoliticianOrganization',  'recordid', 'office') ;
    }

    public function politicians() {
        return $this->hasMany('App\Models\Politician',  'recordid', 'politician') ;
    }

}