<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Airtable_people;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Organization::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appBU3zLf0ORYqKjk',
        ));

        $request = $airtable->getContent( 'organizations' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $organization = new Organization();
                $organization->organization_id = $record[ 'id' ];
                $organization->organizations_id = isset($record['fields']['ID'])?$record['fields']['ID']:null;
                $organization->alternate_name = isset($record['fields']['alternate_name'])?$record['fields']['alternate_name']:null;
                $organization->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                // $organization->dedupe = isset($record['fields']['dedupe'])?$record['fields']['dedupe']:null;
                $organization->type = isset($record['fields']['Type'])?$record['fields']['Type']:null;
                $organization->tags = isset($record['fields']['tags'])? implode(",", $record['fields']['tags']):null;
                $organization->child_of = isset($record['fields']['Child of'])? implode(",", $record['fields']['Child of']):null;
                $website = isset($record['fields']['website'])?$record['fields']['website']:null;
                $website = str_replace("https://","",$website);
                $website = str_replace("http://","",$website);
                $organization->website = $website;
                $organization->description = isset($record['fields']['short description'])?$record['fields']['short description']:null;

                foreach ($record['fields']['Logo'] as $key => $image) {
                    try {
                        $organization->logo .= $image["url"];
                    } catch (Exception $e) {
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
                }

                $organization->Twitter = isset($record['fields']['Twitter'])?$record['fields']['Twitter']:null;
                $organization->Facebook = isset($record['fields']['Facebook'])?$record['fields']['Facebook']:null;
                $organization->RSS = isset($record['fields']['RSS'])?$record['fields']['RSS']:null;
                $organization->contacts_link = isset($record['fields']['contact page'])?$record['fields']['contact page']:null;
                $organization->checkbook = isset($record['fields']['checkbook'])?$record['fields']['checkbook']:null;
                $organization->charter = isset($record['fields']['charter'])?$record['fields']['charter']:null;
                $organization->code = isset($record['fields']['code'])?$record['fields']['code']:null;
                $organization->rules = isset($record['fields']['rules'])?$record['fields']['rules']:null;
                $organization->legislation = isset($record['fields']['legislation'])?$record['fields']['legislation']:null;
                $organization->phones = isset($record['fields']['main_phone'])?$record['fields']['main_phone']:null;
                $organization->email = isset($record['fields']['email'])?$record['fields']['email']:null;
                $organization->main_address = isset($record['fields']['main_address'])?$record['fields']['main_address']:null;
                $organization->legal_status = isset($record['fields']['legal_status'])?$record['fields']['legal_status']:null;
                $organization->tax_status = isset($record['fields']['tax_status'])?$record['fields']['tax_status']:null;
                $organization->tax_id = isset($record['fields']['tax_id'])?$record['fields']['tax_id']:null;
                $organization->year_incorporated = isset($record['fields']['year_incorporated'])?$record['fields']['year_incorporated']:null;
                $organization->internalnotes = isset($record['fields']['internalnotes'])?$record['fields']['internalnotes']:null;                              
                
                $organization ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_people::where('table_name', '=', 'Organizations')->first();
        $airtable->total_records = Organization::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $organizations = Organization::with('phone')->paginate(15);
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
        $organization = Organization::where('id', '=', $id)->first();
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
        $organization = Organization::find($id);
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
