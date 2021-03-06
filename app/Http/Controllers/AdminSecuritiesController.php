<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Securities;
use App\Models\Airtable_politicians;
use App\Models\Dataset_api;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminSecuritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Securities::truncate();
        $api = Dataset_api::find(4);

        $airtable = new Airtable(array(
            'api_key'   => $api->api_key,
            'base'      => $api->api_base,
        ));

        $request = $airtable->getContent( 'Securities' );

        do {

            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $security = new Securities();
                $security->recordid = $record[ 'id' ];
                $security->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $security->politician = isset($record['fields']['Politician'])? implode(",", $record['fields']['Politician']):null; 
                $security->reporting_year = isset($record['fields']['Reporting Year'])?$record['fields']['Reporting Year']:null;
                $security->issuing_entity = isset($record['fields']['Issuing Entity'])?$record['fields']['Issuing Entity']:null;
                $security->type_of_security = isset($record['fields']['Type of Security'])?$record['fields']['Type of Security']:null;
                $security->market_value = isset($record['fields']['Market Value'])?$record['fields']['Market Value']:null;
                $security->percent = isset($record['fields']['Percent Ownership'])?$record['fields']['Percent Ownership']:null;
                
                $security->owns_real_estate = isset($record['fields']['Owns Real Estate'])?$record['fields']['Owns Real Estate']:null;
                $security->owns_securities = isset($record['fields']['Owns Securities'])?$record['fields']['Owns Securities']:null;
                $security->held = isset($record['fields']['Held in Trust'])?$record['fields']['Held in Trust']:null;
                $security->comments = isset($record['fields']['Comments'])?$record['fields']['Comments']:null;
                $security ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'Securities')->first();
        $airtable->total_records = Securities::count();
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
