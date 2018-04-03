<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $table = 'taxonomies';

    public $fillable = ['name','parent_name'];

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany('App\Models\Taxonomy','parent_name','taxonomy_id') ;
    }

    public function parent() {
        return $this->hasMany('App\Models\Taxonomy','taxonomy_id','parent_name') ;
    }

    public $timestamps = false;
}
