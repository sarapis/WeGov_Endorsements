<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Greenbook extends Model
{
    protected $table = 'greenbook';

    protected $fillable = [
    	'addrress',
    	'agency_acronym',
    	'agency_name',
    	'organization_code',
    	'agency_primary_phone',
    	'agency_website',
    	'city',
    	'division_name',
    	'division_primary_phone',
    	'fax_1',
    	'fax_2',
    	'first_name',
    	'grand_parent_division',
    	'great_grand_parentdivision',
    	'last_name',
    	'm_i',
    	'name_suffix',
    	'office_title',
    	'parent_division',
    	'phone_1',
    	'phone_2',
    	'section',
    	'state',
    	'zip_code'

    ];
    public $timestamps = false;

}
