<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceArea;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminServiceAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        ServiceArea::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'service_area' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $service_area = new ServiceArea();
                $service_area->area_id = $record[ 'id' ];
                $service_area->area_name = isset($record['fields']['name'])?$record['fields']['name']:null;
                $service_area->area_services = isset($record['fields']['services'])?$record['fields']['services']:null;
                $service_area->area_description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $service_area->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Service_area')->first();
        $airtable->total_records = ServiceArea::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    
}
