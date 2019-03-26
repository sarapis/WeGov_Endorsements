<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kpi;
use App\Models\Airtable_money;
use App\Functions\Airtable;
use App\Models\Dataset_api;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AdminKpisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Kpi::truncate();
        $api = Dataset_api::find(1);

        $airtable = new Airtable(array(
            'api_key'   => $api->api_key,
            'base'      => $api->api_base,
        ));

        $request = $airtable->getContent( 'kpis' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $kpi = new Kpi();
                $kpi->kpi_recordid = $record[ 'id' ];
                $kpi->kpi_id = isset($record['fields']['id'])?$record['fields']['id']:null;
                $kpi->agency = isset($record['fields']['Agency'])?$record['fields']['Agency']:null;
                $kpi->agency_join = isset($record['fields']['Agency Join'])? implode(",", $record['fields']['Agency Join']):null;
                $kpi->mmr_goal = isset($record['fields']['MMR Goal'])?$record['fields']['MMR Goal']:null;
                $kpi->critical = isset($record['fields']['Critical'])?$record['fields']['Critical']:null;
                $kpi->performance_indicator = isset($record['fields']['Performance Indicator'])?$record['fields']['Performance Indicator']:null;
                $kpi->fy14 = isset($record['fields']['FY14'])?$record['fields']['FY14']:null;
                $kpi->fy15 = isset($record['fields']['FY15'])?$record['fields']['FY15']:null;
                $kpi->fy16 = isset($record['fields']['FY16'])?$record['fields']['FY16']:null;
                $kpi->fy17 = isset($record['fields']['FY17'])?$record['fields']['FY17']:null;
                $kpi->fy18 = isset($record['fields']['FY18'])?$record['fields']['FY18']:null;
                $kpi->desired_direction = isset($record['fields']['Desired Direction'])?$record['fields']['Desired Direction']:null;
                $kpi->trend = isset($record['fields']['Trend'])?$record['fields']['Trend']:null;
                $kpi->tgt18 = isset($record['fields']['TGT18'])?$record['fields']['TGT18']:null;
                $kpi->tgt19 = isset($record['fields']['TGT19'])?$record['fields']['TGT19']:null;
                $kpi->year = isset($record['fields']['year'])?$record['fields']['year']:null;
                $kpi ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_money::where('table_name', '=', 'KPIs')->first();
        $airtable->total_records = Kpi::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        // $projects = Project::leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id', 'projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long', 'projects.flag')->orderBy('projects.project_projectid')->paginate(15);

        $projects = Kpi::paginate(15);

        return view('admin.tables.kpi')->with('projects', $projects);
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
