<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Detail::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'details' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $detail = new Detail();
                $detail->detail_id = $record[ 'id' ];
                $detail->value = isset($record['fields']['value'])?$record['fields']['value']:null;
                $detail->detail_type = isset($record['fields']['detail_type'])?$record['fields']['detail_type']:null;
                $detail->description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $detail->organizations = isset($record['fields']['organizations'])? implode(",", $record['fields']['organizations']):null;
                $detail->services = isset($record['fields']['services'])? implode(",", $record['fields']['services']):null;
                $detail->locations = isset($record['fields']['locations'])? implode(",", $record['fields']['locations']):null;
                $detail->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Details')->first();
        $airtable->total_records = Detail::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $details = Detail::paginate(15);
        return view('admin.tables.detail')->with('details', $details);
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
        $detail = Detail::where('id', '=', $id)->first();
        return response()->json($detail);
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
        $detail = Detail::find($id);
        $detail->value = $request->value;
        $detail->detail_type = $request->detail_type;
        $detail->flag = 'modified';
        $detail->save();

        return response()->json($detail);
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
