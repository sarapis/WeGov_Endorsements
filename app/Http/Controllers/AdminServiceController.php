<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Service::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'services' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $service = new Service();
                $service->service_id = $record[ 'id' ];
                $service->name = isset($record['fields']['name'])?$record['fields']['name']:null;
                $service->organization = isset($record['fields']['organization'])? implode(",", $record['fields']['organization']):null;
                $service->alternate_name = isset($record['fields']['alternate_name'])?$record['fields']['alternate_name']:null;
                $service->description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $service->locations = isset($record['fields']['locations'])? implode(",", $record['fields']['locations']):null;
                $service->url = isset($record['fields']['url'])?$record['fields']['url']:null;
                $service->email = isset($record['fields']['email'])?$record['fields']['email']:null;
                $service->status = isset($record['fields']['status'])? implode(",", $record['fields']['status']):null;
                $service->taxonomy = isset($record['fields']['taxonomy'])? implode(",", $record['fields']['taxonomy']):null;
                $service->application_process = isset($record['fields']['application_process'])?$record['fields']['application_process']:null;
                $service->wait_time = isset($record['fields']['wait_time'])?$record['fields']['wait_time']:null;
                $service->fees = isset($record['fields']['fees'])?$record['fields']['fees']:null;
                $service->accreditations = isset($record['fields']['accreditations'])?$record['fields']['accreditations']:null;
                $service->licenses = isset($record['fields']['licenses'])?$record['fields']['licenses']:null;
                $service->phones = isset($record['fields']['phones'])? implode(",", $record['fields']['phones']):null;
                $service->schedule = isset($record['fields']['schedule'])? implode(",", $record['fields']['schedule']):null;
                $service->contacts = isset($record['fields']['contacts'])? implode(",", $record['fields']['contacts']):null;
                $service->details = isset($record['fields']['details'])? implode(",", $record['fields']['details']):null;
                $service->service_area = isset($record['fields']['service_area'])? implode(",", $record['fields']['service_area']):null;
                $service->metadata= isset($record['fields']['metadata'])?$record['fields']['metadata']:null;
                $service->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Services')->first();
        $airtable->total_records = Service::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    public function index()
    {
        $services = Service::paginate(15);
        return view('admin.tables.service')->with('services', $services);
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
        $service = Service::where('id', '=', $id)->first();
        return response()->json($service);
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
        $service = Service::find($id);
        $service->name = $request->name;
        $service->alternate_name = $request->alternate_name;
        $service->description = $request->description;
        $service->url = $request->url;
        $service->email = $request->email;
        $service->application_process = $request->application_process;
        $service->flag = 'modified';
        $service->save();

        return response()->json($service);
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
