<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Airtable_money;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminAgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Agency::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appytlCBlVIzYxE1o',
        ));

        $request = $airtable->getContent( 'organization' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $agency = new Agency();
                $agency->agency_recordid = $record[ 'id' ];
                $agency->magency = isset($record['fields']['ID'])?$record['fields']['ID']:null;
                $agency->magencyacro = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $agency->magencyname = isset($record['fields']['alternate_name'])?$record['fields']['alternate_name']:null;
                $agency->publish = isset($record['fields']['publish'])?$record['fields']['publish']:null;
                $agency->projects = isset($record['fields']['projects'])? implode(",", $record['fields']['projects']):null;
                $agency->commitments = isset($record['fields']['commitments'])? implode(",", $record['fields']['commitments']):null;
                $agency->commitments_cost = isset($record['fields']['Commitments Cost'])?$record['fields']['Commitments Cost']:null;
                $agency->commitments_noncity_cost = isset($record['fields']['Commitments NonCity Cost'])?$record['fields']['Commitments NonCity Cost']:null;
                $agency->total_project_cost = isset($record['fields']['Total Project Cost'])?$record['fields']['Total Project Cost']:null;
                $agency->expenses = isset($record['fields']['expenses'])? implode(",", $record['fields']['expenses']):null;
                $agency->expenses_link = isset($record['fields']['expenses link'])?$record['fields']['expenses link']:null;
                $agency->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_money::where('table_name', '=', 'Organization')->first();
        $airtable->total_records = Agency::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $agencies = Agency::paginate(15);
        return view('admin.tables.agency')->with('agencies', $agencies);
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
        $agency = Agency::where('id', '=', $id)->first();
        return response()->json($agency);
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
        $agency = Agency::find($id);
        // $project = Project::where('id', '=', $id)->first();
        $agency->magency = $request->magency;
        $agency->magencyname = $request->magencyname;
        $agency->magencyacro = $request->magencyacro;
        $agency->commitments_cost = $request->commitments_cost;
        $agency->commitments_noncity_cost = $request->commitments_noncity_cost;
        $agency->total_project_cost = $request->total_project_cost;
        $agency->expenses_link = $request->expenses_link;
        $agency->publish = $request->publish;
        $agency->flag = 'modified';
        $agency->save();
        // var_dump($project);
        // exit();
        return response()->json($agency);
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
