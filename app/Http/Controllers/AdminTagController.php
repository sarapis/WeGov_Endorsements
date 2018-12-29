<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Tag;
use App\Models\Airtable_people;
use App\Functions\Airtable;

class AdminTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Tag::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appd1eQuF0gFcOMsV',
        ));

        $request = $airtable->getContent( 'tags' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $tag = new Tag();
                $tag->tag_id = $record[ 'id' ];
                $tag->tag_name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $tag->organizations = isset($record['fields']['organizations'])? implode(",", $record['fields']['organizations']):null;
                $tag->tag_description = isset($record['fields']['Description'])?$record['fields']['Description']:null;               
                $tag ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_people::where('table_name', '=', 'Tags')->first();
        $airtable->total_records = Tag::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    
}
