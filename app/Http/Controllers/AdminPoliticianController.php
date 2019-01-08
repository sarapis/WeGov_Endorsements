<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Politician;
use App\Models\Airtable_politicians;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminPoliticianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Politician::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appkzwotOzqU65CKW',
        ));

        $request = $airtable->getContent( 'Politicians' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $politician = new Politician();
                $politician->recordid = $record[ 'id' ];

                $politician->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $politician->politician_id = isset($record['fields']['ID'])?$record['fields']['ID']:null;
                $politician->type = isset($record['fields']['Type'])?$record['fields']['Type']:null;
                $politician->email = isset($record['fields']['Email'])?$record['fields']['Email']:null;
                $politician->phone = isset($record['fields']['Phone'])?$record['fields']['Phone']:null;

                $politician->contact_link = isset($record['fields']['Contact Link'])?$record['fields']['Contact Link']:null;
                $politician->picture = isset($record['fields']['Picture'])?$record['fields']['Picture']:null;
                $politician->current_party_affiliations = isset($record['fields']['Current Party Affiliations'])? implode(",", $record['fields']['Current Party Affiliations']):null; 
                $politician->current_office = isset($record['fields']['Current Office'])? implode(",", $record['fields']['Current Office']):null; 
                $politician->campaigns = isset($record['fields']['Campaigns'])? implode(",", $record['fields']['Campaigns']):null;  
                $politician->endorsements = isset($record['fields']['Endorsements'])? implode(",", $record['fields']['Endorsements']):null; 
                $politician->notes = isset($record['fields']['Notes'])?$record['fields']['Notes']:null;
                $politician->general_information = isset($record['fields']['General Information'])?$record['fields']['General Information']:null;
                $politician->city_positions = isset($record['fields']['City Positions'])? implode(",", $record['fields']['City Positions']):null; 
                $politician->other_noncity_income = isset($record['fields']['Other Noncity Income'])? implode(",", $record['fields']['Other Noncity Income']):null; 
                $politician->list_of_money_you_owe = isset($record['fields']['List of Money You Owe'])? implode(",", $record['fields']['List of Money You Owe']):null; 
                $politician->real_estate = isset($record['fields']['Real Estate'])? implode(",", $record['fields']['Real Estate']):null; 
                $politician->securities = isset($record['fields']['Securities'])? implode(",", $record['fields']['Securities']):null; 
                $politician->trust = isset($record['fields']['Trust'])? implode(",", $record['fields']['Trust']):null; 
                $politician->relatives = isset($record['fields']['Relatives'])? implode(",", $record['fields']['Relatives']):null;
                $politician->general_information2 = isset($record['fields']['General Information 2'])? implode(",", $record['fields']['General Information 2']):null;              
                $politician ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'Politicians')->first();
        $airtable->total_records = Politician::count();
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
