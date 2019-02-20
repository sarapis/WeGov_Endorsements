<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = 'requests';
    public $timestamps = false;

    public function community() {
        return $this->belongsTo('App\Models\Agency',  'community_board', 'agency_recordid') ;
    }

    public function responsible() {
        return $this->belongsTo('App\Models\Agency',  'responsible_agency', 'agency_recordid') ;
    }

}