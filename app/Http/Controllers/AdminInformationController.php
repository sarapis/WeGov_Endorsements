<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Airtable_politicians;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Information::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appkzwotOzqU65CKW',
        ));

        $request = $airtable->getContent( 'General Information' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $information = new Information();
                $information->recordid = $record[ 'id' ];
                $information->report_for = isset($record['fields']['Report For'])?$record['fields']['Report For']:null;
                $information->politician = isset($record['fields']['Politician'])? implode(",", $record['fields']['Politician']):null; 
                $information->reporting_year = isset($record['fields']['Reporting Year'])?$record['fields']['Reporting Year']:null;
                $information->first_name = isset($record['fields']['First Name'])?$record['fields']['First Name']:null;
                $information->middle_initial = isset($record['fields']['Middle Initial'])?$record['fields']['Middle Initial']:null;
                $information->last_name = isset($record['fields']['Last Name'])?$record['fields']['Last Name']:null;
                $information->last_name = isset($record['fields']['Last Name'])?$record['fields']['Last Name']:null;
                $information->termination_report = isset($record['fields']['Is Termination Report'])?$record['fields']['Is Termination Report']:null;
                $information->termination_date = isset($record['fields']['Termination Date'])?$record['fields']['Termination Date']:null;
                $information->reason_for_filing = isset($record['fields']['Reason for Filing'])?$record['fields']['Reason for Filing']:null;
                $information->info1 = isset($record['fields']['1'])?$record['fields']['1']:null;
                $information->info2 = isset($record['fields']['2'])?$record['fields']['2']:null;
                $information->info3 = isset($record['fields']['3'])?$record['fields']['3']:null;
                $information->info4 = isset($record['fields']['4'])?$record['fields']['4']:null;
                $information->info5 = isset($record['fields']['5'])?$record['fields']['5']:null;
                $information->info6 = isset($record['fields']['6'])?$record['fields']['6']:null;
                $information->info7 = isset($record['fields']['7'])?$record['fields']['7']:null;
                $information->info8 = isset($record['fields']['8'])?$record['fields']['8']:null;
                $information->info9 = isset($record['fields']['9'])?$record['fields']['9']:null;
                $information->info10 = isset($record['fields']['10'])?$record['fields']['10']:null;
                $information->info11 = isset($record['fields']['11'])?$record['fields']['11']:null;
                $information->info12 = isset($record['fields']['12'])?$record['fields']['12']:null;
                $information->info13 = isset($record['fields']['13'])?$record['fields']['13']:null;
                $information->info14 = isset($record['fields']['14'])?$record['fields']['14']:null;
                $information->info15 = isset($record['fields']['15'])?$record['fields']['15']:null;
                $information->info16 = isset($record['fields']['16'])?$record['fields']['16']:null;
                $information->info17 = isset($record['fields']['17'])?$record['fields']['17']:null;
                $information->info18 = isset($record['fields']['18'])?$record['fields']['18']:null;
                $information->info19 = isset($record['fields']['19'])?$record['fields']['1']:null;
                $information->info20 = isset($record['fields']['20'])?$record['fields']['20']:null;
                $information->info21 = isset($record['fields']['21'])?$record['fields']['21']:null;
                $information->info22 = isset($record['fields']['22'])?$record['fields']['22']:null;
                $information->report_link = isset($record['fields']['Report Link'])?$record['fields']['Report Link']:null;
                $information->pdf_report = isset($record['fields']['PDF Report'])?$record['fields']['PDF Report']:null;
                $information ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'General_information')->first();
        $airtable->total_records = Information::count();
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
