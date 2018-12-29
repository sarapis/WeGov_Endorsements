<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Airtable_people;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Phone::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appd1eQuF0gFcOMsV',
        ));

        $request = $airtable->getContent( 'phones' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $phone = new Phone();
                $phone->phone_id = $record[ 'id' ];
                $phone->phone_number = isset($record['fields']['number'])?$record['fields']['number']:null;
                $phone->organizations = isset($record['fields']['organizations'])? implode(",", $record['fields']['organizations']):null;
                $phone->contacts = isset($record['fields']['contacts'])? implode(",", $record['fields']['contacts']):null;
                $phone->extension = isset($record['fields']['extension'])?$record['fields']['extension']:null;
                $phone->type = isset($record['fields']['type'])?$record['fields']['type']:null;
                $phone->language = isset($record['fields']['language'])? implode(",", $record['fields']['language']):null;
                $phone->description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $phone->schedule = isset($record['fields']['schedule'])?$record['fields']['schedule']:null;
                $phone->source = isset($record['fields']['Source'])?$record['fields']['Source']:null;
                $phone ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_people::where('table_name', '=', 'Phones')->first();
        $airtable->total_records = Phone::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $phones = Phone::paginate(15);
        return view('admin.tables.phone')->with('phones', $phones);
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
        $phone = Phone::where('id', '=', $id)->first();
        return response()->json($phone);

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
        $phone = Phone::find($id);
        $phone->phone_number = $request->phone_number;
        $phone->service_at_location_id = $request->service_at_location_id;
        $phone->extension = $request->extension;
        $phone->type = $request->type;
        $phone->description = $request->description;
        $phone->flag = 'modified';
        $phone->save();

        return response()->json($phone);
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
