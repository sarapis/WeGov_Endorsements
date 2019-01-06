<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicePhone;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminServicePhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        ServicePhone::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'phones' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $service_phone = new ServicePhone();
                $service_phone->phone_recordid = $record[ 'id' ];
                $service_phone->services_phone_number = isset($record['fields']['number'])?$record['fields']['number']:null;
                $service_phone->services_phone_locations = isset($record['fields']['locations'])? implode(",", $record['fields']['locations']):null;
                $service_phone->services_phone_services = isset($record['fields']['services'])? implode(",", $record['fields']['services']):null;
                $service_phone->services_phone_organizations = isset($record['fields']['organizations'])? implode(",", $record['fields']['organizations']):null;
                $service_phone->services_phone_contacts = isset($record['fields']['contacts'])?$record['fields']['contacts']:null;
                $service_phone->services_phone_extension = isset($record['fields']['extension'])?$record['fields']['extension']:null;
                $service_phone->services_phone_type = isset($record['fields']['type'])?$record['fields']['type']:null;
                $service_phone->services_phone_language = isset($record['fields']['language'])? implode(",", $record['fields']['language']):null;
                $service_phone->services_phone_description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $service_phone->services_phone_schedule = isset($record['fields']['schedule'])? implode(",", $record['fields']['schedule']):null;
                $service_phone->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Services_phones')->first();
        $airtable->total_records = ServicePhone::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    
}
