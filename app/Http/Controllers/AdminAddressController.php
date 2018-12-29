<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Address;
use App\Models\Airtable_people;
use App\Functions\Airtable;

class AdminAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Address::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appd1eQuF0gFcOMsV',
        ));

        $request = $airtable->getContent( 'address' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $address = new Address();
                $address->address_id = $record[ 'id' ];
                $address->address_1 = isset($record['fields']['address_1'])?$record['fields']['address_1']:null;
                $address->city = isset($record['fields']['city'])?$record['fields']['city']:null;
                $address->state_province = isset($record['fields']['state_province'])?$record['fields']['state_province']:null;
                $address->postal_code = isset($record['fields']['postal_code'])?$record['fields']['postal_code']:null;
                $address->contact = isset($record['fields']['Contact'])? implode(",", $record['fields']['Contact']):null;
                $address->postal_code = isset($record['fields']['postal_code'])?$record['fields']['postal_code']:null;
                $address->attention = isset($record['fields']['attention'])?$record['fields']['attention']:null;
                $address->locations = isset($record['fields']['locations'])?$record['fields']['locations']:null;
                $address->region = isset($record['fields']['region'])?$record['fields']['region']:null;
                $address->country = isset($record['fields']['country'])?$record['fields']['country']:null;
                $address->address_type = isset($record['fields']['address_type'])? implode(",", $record['fields']['address_type']):null;
                $address->latitude = isset($record['fields']['latitude'])?$record['fields']['latitude']:null;
                $address->longitude = isset($record['fields']['longitude'])?$record['fields']['longitude']:null;
                $address->sources = isset($record['fields']['Sources'])?$record['fields']['Sources']:null;
                $address->organizations = isset($record['fields']['organizations'])? implode(",", $record['fields']['organizations']):null;
                $address ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_people::where('table_name', '=', 'Address')->first();
        $airtable->total_records = Address::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    
    public function index()
    {
        $adds = Address::paginate(15);
        return view('admin.tables.address')->with('adds', $adds);
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
        $address = Address::where('id', '=', $id)->first();
        return response()->json($address);
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
        $address = Address::find($id);
        $address->address_1 = $request->address_1;
        $address->city = $request->city;
        $address->state_province = $request->state_province;
        $address->postal_code = $request->postal_code;
        $address->attention = $request->attention;
        $address->region = $request->region;
        $address->country = $request->country;
        $address->flag = 'modified';
        $address->save();

        return response()->json($address);
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
