<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endorsement;
use App\Models\Airtable_politicians;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminEndorsementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Endorsement::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appkzwotOzqU65CKW',
        ));

        $request = $airtable->getContent( 'Endorsements' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $endorsement = new Endorsement();
                $endorsement->recordid = $record[ 'id' ];
                $endorsement->endorsement_id = isset($record['fields']['ID'])?$record['fields']['ID']:null;
                $endorsement->organizations = isset($record['fields']['Organizations'])? implode(",", $record['fields']['Organizations']):null; 
                $endorsement->endorsed = isset($record['fields']['Endorsed'])? implode(",", $record['fields']['Endorsed']):null; 
                $endorsement->office = isset($record['fields']['Office'])? implode(",", $record['fields']['Office']):null; 
                $endorsement->election = isset($record['fields']['Election'])? implode(",", $record['fields']['Election']):null;
                $endorsement->link = isset($record['fields']['Link'])?$record['fields']['Link']:null;
                $endorsement->statement = isset($record['fields']['Statement'])?$record['fields']['Statement']:null;
                $endorsement->date_published = isset($record['fields']['Date Published'])?$record['fields']['Date Published']:null;  
                $endorsement->campaigns = isset($record['fields']['Campaigns'])? implode(",", $record['fields']['Campaigns']):null;  
                $endorsement->file = isset($record['fields']['File'])?$record['fields']['File']:null;
                $endorsement->date_recorded = isset($record['fields']['Date Recorded'])?$record['fields']['Date Recorded']:null;
                $endorsement->submission_name = isset($record['fields']['Submission Name'])?$record['fields']['Submission Name']:null;
                $endorsement->submitted_email = isset($record['fields']['Submitted Email'])?$record['fields']['Submitted Email']:null;
                $endorsement->submitted_phone = isset($record['fields']['Submitted Phone'])?$record['fields']['Submitted Phone']:null;   
                $endorsement ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'Endorsements')->first();
        $airtable->total_records = Endorsement::count();
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
