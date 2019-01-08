<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliticianOrganization;
use App\Models\Airtable_politicians;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminPoliticianOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        PoliticianOrganization::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appkzwotOzqU65CKW',
        ));

        $request = $airtable->getContent( 'Organizations' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $organization = new PoliticianOrganization();
                $organization->recordid = $record[ 'id' ];

                $organization->organization = isset($record['fields']['Organization'])?$record['fields']['Organization']:null;
                $organization->organizationid = isset($record['fields']['Organization ID'])?$record['fields']['Organization ID']:null;
                $organization->type = isset($record['fields']['Type'])?$record['fields']['Type']:null;
                $organization->tags = isset($record['fields']['Tags'])? implode(",", $record['fields']['Tags']):null;  
                $organization->email = isset($record['fields']['Email'])?$record['fields']['Email']:null;

                $organization->twitter = isset($record['fields']['Twitter'])?$record['fields']['Twitter']:null;
                $organization->website = isset($record['fields']['Website'])?$record['fields']['Website']:null;
                $organization->facebook = isset($record['fields']['Facebook'])?$record['fields']['Facebook']:null;
                $organization->phone = isset($record['fields']['Phone'])?$record['fields']['Phone']:null;

                $organization->address = isset($record['fields']['Address'])?$record['fields']['Address']:null;
                $organization->endorsement_log = isset($record['fields']['Endorsement Log'])? implode(",", $record['fields']['Endorsement Log']):null;  

                $organization->description = isset($record['fields']['Description'])?$record['fields']['Description']:null;  
                $organization->notes = isset($record['fields']['Notes'])?$record['fields']['Notes']:null;
                $organization ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'Politician_organizations')->first();
        $airtable->total_records = PoliticianOrganization::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $organizations = PoliticianOrganization::with('phone')->paginate(15);
        return view('admin.tables.organization')->with('organizations', $organizations);
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
        $organization = PoliticianOrganization::where('id', '=', $id)->first();
        return response()->json($organization);
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
        $organization = PoliticianOrganization::find($id);
        $organization->organizations_id = $request->organizations_id;
        $organization->alternate_name = $request->alternate_name;
        $organization->name = $request->name;
        $organization->type = $request->type;
        $organization->website = $request->website;
        $organization->description = $request->description;
        $organization->logo = $request->logo;
        $organization->checkbook = $request->checkbook;
        $organization->internalnotes = $request->internalnotes;
        $organization->contacts_link = $request->contacts_link;
        $organization->dedupe = $request->dedupe;
        $organization->flag = 'modified';
        $organization->save();
        // var_dump($project);
        // exit();
        return response()->json($organization);
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
