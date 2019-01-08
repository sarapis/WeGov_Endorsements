<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Airtable_politicians;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Position::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appkzwotOzqU65CKW',
        ));

        $request = $airtable->getContent( 'City Positions' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $position = new Position();
                $position->recordid = $record[ 'id' ];
                $position->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $position->politician = isset($record['fields']['Politician'])? implode(",", $record['fields']['Politician']):null; 
                $position->reporting_year = isset($record['fields']['Reporting Year'])?$record['fields']['Reporting Year']:null;
                $position->current_final_agency = isset($record['fields']['Current/Final Agency'])?$record['fields']['Current/Final Agency']:null;
                $position->status = isset($record['fields']['Status'])?$record['fields']['Status']:null;
                $position->borough = isset($record['fields']['Borough/Country'])?$record['fields']['Borough/Country']:null;
                $position->district = isset($record['fields']['District'])?$record['fields']['District']:null;
                $position->address = isset($record['fields']['Address'])?$record['fields']['Address']:null;
                $position->telephone = isset($record['fields']['Telephone'])?$record['fields']['Telephone']:null;
                $position->position_title = isset($record['fields']['Position Title'])?$record['fields']['Position Title']:null;
                $position->position_title = isset($record['fields']['Position Title'])?$record['fields']['Position Title']:null;
                $position->nature_of_income = isset($record['fields']['Nature of Income'])?$record['fields']['Nature of Income']:null;
                $position->income = isset($record['fields']['Income'])?$record['fields']['Income']:null;
                $position->comments = isset($record['fields']['Comments'])?$record['fields']['Comments']:null;
                $position ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'City_positions')->first();
        $airtable->total_records = Position::count();
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
