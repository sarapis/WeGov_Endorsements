<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxonomy;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminTaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Taxonomy::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'taxonomy' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $taxonomy = new Taxonomy();
                $taxonomy->taxonomy_id = $record[ 'id' ];
                $taxonomy->name = isset($record['fields']['name'])?$record['fields']['name']:null;
                $taxonomy->parent_name = isset($record['fields']['parent_name'])? implode(",", $record['fields']['parent_name']):null;
                $taxonomy->vocabulary = isset($record['fields']['vocabulary'])?$record['fields']['vocabulary']:null;
                $taxonomy->x_description = isset($record['fields']['x-description'])?$record['fields']['x-description']:null;
                $taxonomy->x_notes = isset($record['fields']['x-notes'])?$record['fields']['x-notes']:null;
                $taxonomy->services = isset($record['fields']['services'])? implode(",", $record['fields']['services']):null;
                $taxonomy->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Taxonomy')->first();
        $airtable->total_records = Taxonomy::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $taxonomies = Taxonomy::paginate(15);
        return view('admin.tables.taxonomy')->with('taxonomies', $taxonomies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $taxonomy = Taxonomy::where('id', '=', $id)->first();
        return response()->json($taxonomy);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $taxonomy = Taxonomy::find($id);
        $taxonomy->name = $request->name;
        $taxonomy->vocabulary = $request->vocabulary;
        $taxonomy->flag = 'modified';
        $taxonomy->save();

        return response()->json($taxonomy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
