<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceAddress;
use App\Models\Airtable_services;
use App\Models\Dataset_api;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminServiceAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        ServiceAddress::truncate();
        $api = Dataset_api::find(3);

        $airtable = new Airtable(array(
            'api_key'   => $api->api_key,
            'base'      => $api->api_base,
        ));

        $request = $airtable->getContent( 'address' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $service_address = new ServiceAddress();
                $service_address->address_recordid = $record[ 'id' ];
                $service_address->services_address_1 = isset($record['fields']['address_1'])?$record['fields']['address_1']:null;
                $service_address->services_address_id = isset($record['fields']['id'])?$record['fields']['id']:null;
                $service_address->services_address_city = isset($record['fields']['city'])?$record['fields']['city']:null;
                $service_address->services_address_state_province = isset($record['fields']['state_province'])?$record['fields']['state_province']:null;
                $service_address->services_address_state_province = isset($record['fields']['state_province'])?$record['fields']['state_province']:null;
                $service_address->services_address_postalcode = isset($record['fields']['postal_code'])?$record['fields']['postal_code']:null;
                $service_address->services_address_region = isset($record['fields']['region'])?$record['fields']['region']:null;
                $service_address->services_address_country = isset($record['fields']['country'])?$record['fields']['country']:null;
                $service_address->services_address_attention = isset($record['fields']['y-attention'])?$record['fields']['y-attention']:null;
                $service_address->services_address_type = isset($record['fields']['y-address_type'])? implode(",", $record['fields']['y-address_type']):null;
                $service_address->services_address_locations = isset($record['fields']['locations'])? implode(",", $record['fields']['locations']):null;
                $service_address->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Services_address')->first();
        $airtable->total_records = ServiceAddress::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    
}
