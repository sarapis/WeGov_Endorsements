<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Requests;
use App\Models\Airtable_money;
use App\Functions\Airtable;
use App\Models\Dataset_api;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AdminRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Requests::truncate();
        $api = Dataset_api::find(1);

        $airtable = new Airtable(array(
            'api_key'   => $api->api_key,
            'base'      => $api->api_base,
        ));

        $request = $airtable->getContent( 'cb_requests' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $project = new Requests();
                $project->request_recordid = $record[ 'id' ];
                $project->tracking_code = isset($record['fields']['tracking code'])?$record['fields']['tracking code']:null;
                $project->borough = isset($record['fields']['borough'])?$record['fields']['borough']:null;
                $project->district = isset($record['fields']['district'])?$record['fields']['district']:null;
                $project->community_board = isset($record['fields']['community board'])? implode(",", $record['fields']['community board']):null;
                $project->priority = isset($record['fields']['priority #'])?$record['fields']['priority #']:null;
                $project->request = isset($record['fields']['request'])?$record['fields']['request']:null;
                $project->explanation = isset($record['fields']['explanation'])?$record['fields']['explanation']:null;
                $project->responsible_agency = isset($record['fields']['responsible agency'])? implode(",", $record['fields']['responsible agency']):null;
                $project->budget_line = isset($record['fields']['budget line'])?$record['fields']['budget line']:null;
                $project->project_id = isset($record['fields']['project id'])?$record['fields']['project id']:null;
                $project->location_name = isset($record['fields']['location name'])?$record['fields']['location name']:null;
                $project->location_address = isset($record['fields']['location address'])?$record['fields']['location address']:null;
                $project->cross_street_1 = isset($record['fields']['cross street 1'])?$record['fields']['cross street 1']:null;
                $project->cross_street_2 = isset($record['fields']['cross street 2'])?$record['fields']['cross street 2']:null;
                $project->site_block = isset($record['fields']['site block'])?$record['fields']['site block']:null;
                $project->lot = isset($record['fields']['lot'])?$record['fields']['lot']:null;
                $project->supported_by = isset($record['fields']['supported by'])?$record['fields']['supported by']:null;
                $project->source_of_request = isset($record['fields']['source of request'])?$record['fields']['source of request']:null;
                $project->response = isset($record['fields']['response'])?$record['fields']['response']:null;
                $project->requested_by = isset($record['fields']['Requested By'])? implode(",", $record['fields']['Requested By']):null;
                $project->requested_from = isset($record['fields']['Requested From'])? implode(",", $record['fields']['Requested From']):null;
                $project ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_money::where('table_name', '=', 'Cb_requests')->first();
        $airtable->total_records = Requests::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        // $projects = Project::leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id', 'projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long', 'projects.flag')->orderBy('projects.project_projectid')->paginate(15);

        $projects = Requests::paginate(15);

        return view('admin.tables.project')->with('projects', $projects);
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
        $product = Requests::where('project_projectid', '=', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id', 'projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long')->first();
        return response()->json($product);
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
        $project = Requests::find($id);
        // $project = Project::where('id', '=', $id)->first();
        $project->project_projectid = $request->project_projectid;
        $project->project_description = $request->project_description;
        $project->project_citycost = $request->project_citycost;
        $project->project_noncitycost = $request->project_noncitycost;
        $project->project_totalcost = $request->project_totalcost;
        $project->project_type = $request->project_type;
        $project->project_lat = $request->project_lat;
        $project->project_long = $request->project_long;
        $project->flag = 'modified';
        $project->save();
        // var_dump($project);
        // exit();
        return response()->json($project);
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
