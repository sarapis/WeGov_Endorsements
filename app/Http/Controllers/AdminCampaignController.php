<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Airtable_politicians;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Campaign::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appkzwotOzqU65CKW',
        ));

        $request = $airtable->getContent( 'Campaigns' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $campaign = new Campaign();
                $campaign->recordid = $record[ 'id' ];
                $campaign->campaign_id = isset($record['fields']['ID'])?$record['fields']['ID']:null;
                $campaign->office = isset($record['fields']['Office'])? implode(",", $record['fields']['Office']):null; 
                $campaign->politician = isset($record['fields']['Politician'])? implode(",", $record['fields']['Politician']):null; 
                $campaign->parties = isset($record['fields']['Parties'])? implode(",", $record['fields']['Parties']):null; 
                $campaign->cycle = isset($record['fields']['Cycle'])? implode(",", $record['fields']['Cycle']):null; 
                $campaign->endorsements = isset($record['fields']['Endorsements'])? implode(",", $record['fields']['Endorsements']):null; 
                $campaign->status = isset($record['fields']['Status'])?$record['fields']['Status']:null;
                $campaign->website = isset($record['fields']['Website'])?$record['fields']['Website']:null;
                $campaign->facebook = isset($record['fields']['Facebook'])?$record['fields']['Facebook']:null;
                $campaign->twitter = isset($record['fields']['Twitter'])?$record['fields']['Twitter']:null;
                $campaign->address = isset($record['fields']['Address'])?$record['fields']['Address']:null;
                $campaign->image = isset($record['fields']['Image'])?$record['fields']['Image']:null;
                $campaign->profiles = isset($record['fields']['Profiles'])?$record['fields']['Profiles']:null;
                $campaign->notes = isset($record['fields']['Notes'])?$record['fields']['Notes']:null;     
                $campaign ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'Campaigns')->first();
        $airtable->total_records = Campaign::count();
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
