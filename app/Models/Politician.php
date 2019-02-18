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

}