<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Location::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'locations' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $location = new Location();
                $location->location_id = $record[ 'id' ];
                $location->name = isset($record['fields']['name'])?$record['fields']['name']:null;
                $location->organization = isset($record['fields']['organization'])? implode(",", $record['fields']['organization']):null;
                $location->alternate_name = isset($record['fields']['alternate_name'])?$record['fields']['alternate_name']:null;
                $location->transportation = isset($record['fields']['transportation'])?$record['fields']['transportation']:null;
                $location->latitude = isset($record['fields']['latitude'])?$record['fields']['latitude']:null;
                $location->longitude = isset($record['fields']['longitude'])?$record['fields']['longitude']:null;
                $location->description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $location->services = isset($record['fields']['services'])? implode(",", $record['fields']['services']):null;
                $location->phones = isset($record['fields']['phones'])? implode(",", $record['fields']['phones']):null;
                $location->details = isset($record['fields']['details'])? implode(",", $record['fields']['details']):null;
                $location->schedule = isset($record['fields']['schedule'])? implode(",", $record['fields']['schedule']):null;
                $location->address = isset($record['fields']['address'])? implode(",", $record['fields']['address']):null;
                $location->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Locations')->first();
        $airtable->total_records = Location::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $locations = Location::paginate(15);
        return view('admin.tables.location')->with('locations', $locations);
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
        $location = Location::where('id', '=', $id)->first();
        return response()->json($location);
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
        $location = Location::find($id);
        $location->name = $request->name;
        $location->alternate_name = $request->alternate_name;
        $location->transportation = $request->transportation;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->description = $request->description;
        $location->flag = 'modified';
        $location->save();

        return response()->json($location);
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
