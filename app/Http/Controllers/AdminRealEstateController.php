<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realestate;
use App\Models\Airtable_politicians;
use App\Models\Dataset_api;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminRealEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Realestate::truncate();
        $api = Dataset_api::find(4);

        $airtable = new Airtable(array(
            'api_key'   => $api->api_key,
            'base'      => $api->api_base,
        ));

        $request = $airtable->getContent( 'Real Estate' );

        do {

            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $realestate = new Realestate();
                $realestate->recordid = $record[ 'id' ];
                $realestate->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $realestate->politician = isset($record['fields']['Politician'])? implode(",", $record['fields']['Politician']):null; 
                $realestate->reporting_year = isset($record['fields']['Reporting Year'])?$record['fields']['Reporting Year']:null;
                $realestate->address = isset($record['fields']['Address'])?$record['fields']['Address']:null;
                $realestate->size_of_property = isset($record['fields']['Size of Property'])?$record['fields']['Size of Property']:null;
                $realestate->nature_of_property = isset($record['fields']['Nature of Property'])?$record['fields']['Nature of Property']:null;
                $realestate->describe = isset($record['fields']['If Other, Describe'])?$record['fields']['If Other, Describe']:null;
                
                $realestate->acquisition_date = isset($record['fields']['Acquisition Date'])?$record['fields']['Acquisition Date']:null;
                $realestate->percentage = isset($record['fields']['Percentage Ownership'])?$record['fields']['Percentage Ownership']:null;
                $realestate->market_value = isset($record['fields']['Market Value'])?$record['fields']['Market Value']:null;
                $realestate->comments = isset($record['fields']['Comments'])?$record['fields']['Comments']:null;
                $realestate ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'Real_estate')->first();
        $airtable->total_records = Realestate::count();
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
