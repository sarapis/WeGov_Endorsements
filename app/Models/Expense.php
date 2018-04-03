<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    public $timestamps = false;

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency', 'agency_number', 'agency_recordid');
    }

}
