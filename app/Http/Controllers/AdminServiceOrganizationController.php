<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceOrganization;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminServiceOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        ServiceOrganization::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'organizations' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $service_organization = new ServiceOrganization();
                $service_organization->organization_recordid = $record[ 'id' ];
                $service_organization->organization_x_id = isset($record['fields']['x-id'])?$record['fields']['x-id']:null;
                $service_organization->organization_name = isset($record['fields']['name'])?$record['fields']['name']:null;
                $service_organization->organization_alternate_name = isset($record['fields']['alternate_name'])?$record['fields']['alternate_name']:null;
                $service_organization->organization_description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $service_organization->organization_email = isset($record['fields']['email'])?$record['fields']['email']:null;
                $service_organization->organization_url = isset($record['fields']['url'])?$record['fields']['url']:null;
                $service_organization->organization_legal_status = isset($record['fields']['legal_status'])?$record['fields']['legal_status']:null;
                $service_organization->organization_tax_status = isset($record['fields']['tax_status'])?$record['fields']['tax_status']:null;
                $service_organization->organization_tax_id = isset($record['fields']['tax_id'])?$record['fields']['tax_id']:null;
                $service_organization->organization_year_incorporated= isset($record['fields']['year_incorporated'])?$record['fields']['year_incorporated']:null;
                $service_organization->organization_services = isset($record['fields']['services'])? implode(",", $record['fields']['services']):null;
                $service_organization->organization_phones = isset($record['fields']['phones'])? implode(",", $record['fields']['phone']):null;
                $service_organization->organization_locations = isset($record['fields']['locations'])? implode(",", $record['fields']['locations']):null;
                $service_organization->organization_contact = isset($record['fields']['contact'])? implode(",", $record['fields']['contact']):null;
                $service_organization->organization_details = isset($record['fields']['details'])? implode(",", $record['fields']['details']):null;
                $service_organization->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Services_Organizations')->first();
        $airtable->total_records = ServiceOrganization::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    
}
