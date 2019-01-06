<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceContact;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminServiceContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        ServiceContact::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'contact' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $service_contact = new ServiceContact();
                $service_contact->contact_recordid = $record[ 'id' ];
                $service_contact->contact_name = isset($record['fields']['name'])?$record['fields']['name']:null;
                $service_contact->contact_organization = isset($record['fields']['organizations'])? implode(",", $record['fields']['organizations']):null;
                $service_contact->contact_services = isset($record['fields']['services'])? implode(",", $record['fields']['services']):null;
                $service_contact->contact_title = isset($record['fields']['title'])?$record['fields']['title']:null;
                $service_contact->contact_email = isset($record['fields']['email'])?$record['fields']['email']:null;
                $service_contact->contact_phones = isset($record['fields']['phones'])? implode(",", $record['fields']['phones']):null;
                $service_contact->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Contact')->first();
        $airtable->total_records = ServiceContact::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    
}
