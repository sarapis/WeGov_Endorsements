<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Airtable_money;
use App\Functions\Airtable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Project::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appytlCBlVIzYxE1o',
        ));

        $request = $airtable->getContent( 'projects' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $project = new Project();
                $project->project_recordid = $record[ 'id' ];
                $project->project_projectid = isset($record['fields']['projectid'])?$record['fields']['projectid']:null;
                $project->project_managingagency = isset($record['fields']['managingagency'])? implode(",", $record['fields']['managingagency']):null;
                $project->project_description = isset($record['fields']['description'])?$record['fields']['description']:null;
                $project->project_citycost = isset($record['fields']['citycost'])?$record['fields']['citycost']:null;
                $project->project_noncitycost = isset($record['fields']['noncitycost'])?$record['fields']['noncitycost']:null;
                $project->project_totalcost = isset($record['fields']['totalcost'])?$record['fields']['totalcost']:null;
                $project->project_commitments = isset($record['fields']['commitments'])? implode(",", $record['fields']['commitments']):null;
                $project->project_type = isset($record['fields']['project type'])?$record['fields']['project type']:null;
                $postion = isset($record['fields']['lat/long'])? explode(",", $record['fields']['lat/long']):null;
                $project->project_lat = floatval($postion[0]);
                $project->project_long = floatval($postion[1]);
                $project->related_additions = isset($record['fields']['related_additions'])? implode(",", $record['fields']['related_additions']):null;
                $project ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_money::where('table_name', '=', 'Projects')->first();
        $airtable->total_records = Project::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        // $projects = Project::leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id', 'projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long', 'projects.flag')->orderBy('projects.project_projectid')->paginate(15);

        $projects = Project::paginate(15);

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
        $product = Project::where('project_projectid', '=', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id', 'projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long')->first();
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
        $project = Project::find($id);
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
