<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Airtable_politicians;
use App\Models\Dataset_api;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Election::truncate();
        $api = Dataset_api::find(4);

        $airtable = new Airtable(array(
            'api_key'   => $api->api_key,
            'base'      => $api->api_base,
        ));

        $request = $airtable->getContent( 'Elections' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $election = new Election();
                $election->recordid = $record[ 'id' ];
                $election->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $election->campaigns = isset($record['fields']['Campaigns'])? implode(",", $record['fields']['Campaigns']):null; 
                $election->election_day = isset($record['fields']['Election Day'])?$record['fields']['Election Day']:null;
                $election->year = isset($record['fields']['Year'])?$record['fields']['Year']:null;
                $election->description = isset($record['fields']['Description'])?$record['fields']['Description']:null;             
                $election->offices = isset($record['fields']['Offices'])? implode(",", $record['fields']['Offices']):null; 
                $election->of_offices = isset($record['fields']['# of Offices'])?$record['fields']['# of Offices']:null;
                $election->of_candidates = isset($record['fields']['# of Candidates'])?$record['fields']['# of Candidates']:null;
                $election->of_endorsements = isset($record['fields']['# of Endorsements'])?$record['fields']['# of Endorsements']:null;
                $election ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'Elections')->first();
        $airtable->total_records = Election::count();
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
