<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Taxonomy;
use App\Models\Service;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
//use Cornford\Googlmapper\Mapper;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //     protected $pro;

    // public function __construct(Pro $pro)
    // {
    //     $this->pro = $pro;
    // }

    public function projectview()
    {
        $project_types = Project::distinct()->get(['project_type']);
        $organizations = Agency::orderBy('magencyacro', 'asc')->get();

        $allprojects = Project::leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id','projects.project_recordid','projects.project_projectid','agencies.magency','agencies.magencyacro','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_type')->sortable(['project_projectid'])->paginate(20);

        $projects = Project::all();

        return view('frontend.projects', compact('project_types', 'organizations', 'allprojects', 'projects'));
    }

    public function filter(Request $request)
    {
        $ids = $request->organization_value;

        $project_type = $request->project_type;
         
        $check = 0;


        if(isset($ids[0])){
            $allprojects = Project::whereIn('project_managingagency',$ids);
            $check = 1;
        }
        if(isset($project_type[0])){
            if($check == 0)
                $allprojects = Project::where('project_type',$project_type[0]);
            else
                $allprojects = $allprojects->where(function ($query) use($project_type) {
                for($i = 0; $i < count($project_type); $i++)
                    $query->orwhere('project_type', 'like', '%'.$project_type[$i].'%');
            });
            $check = 1;

        }

        if($check == 1)
            $allprojects = $allprojects->get();
        else
            $allprojects =  Project::all();

        $projects = Project::all();

        return view('frontend.projects_filter', compact('allprojects', 'projects'))->render();
    }


    public function search(Request $request)
    {
        $find = $request->search_project;

        $allprojects = Project::where('project_projectid', 'like', '%'.$find.'%')
            ->orwhere('project_description', 'like', '%'.$find.'%')->get();

        return view('frontend.projects_filter', compact('allprojects'))->render();
    }

    public function find($id, $project_id)
    {   

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('tags', 'organizations.tags', 'like', DB::raw("concat('%', tags.tag_id, '%')"))->select('organizations.*', 'organizations.description as organization_description', DB::raw('group_concat(DISTINCT(tags.tag_name)) as tag_names'))->groupBy('organizations.organization_id')->first();


        $project = DB::table('projects')->where('project_projectid', $project_id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long')->first();

        $commitments = DB::table('commitments')->where('projectid', $id)->get();
        return view('frontend.organization_project', compact('organization', 'commitments','project'))->render();
    }

    public function projectfind($id)
    {   

        $project = DB::table('projects')->where('project_projectid', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long')->first();

        $projectid = DB::table('projects')->where('project_projectid', $id)->first()->project_recordid;

        $organization_id = DB::table('organizations')->where('name', '=', $project->magencyacro)->first()->organizations_id;

        $commitments = DB::table('commitments')->where('projectid', '=', $projectid)->get();
        return view('frontend.project', compact('organization_id', 'commitments','project'))->render();
    }

    public function project($id)
    {   
        $project_types = Project::distinct()->get(['project_type']);
        $organizations = Agency::orderBy('magencyacro', 'asc')->get();

        $project = DB::table('projects')->where('project_projectid', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long')->first();

        $projectid = DB::table('projects')->where('project_projectid', $id)->first()->project_recordid;

        $organization_id = DB::table('organizations')->where('name', '=', $project->magencyacro)->first()->organizations_id;

        $commitments = DB::table('commitments')->where('projectid', $projectid)->get();
        return view('frontend.project1', compact('project_types', 'organizations', 'organization_id', 'commitments','project'))->render();
    }

    public function category($id)
    {
        //$pros = $this->pro->first();

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = $id;
        $filter = collect([$organization_name, $service_name, $project_name]);

        $allprojects = Project::where('project_type', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id','projects.project_recordid','projects.project_projectid', 'agencies.magency', 'agencies.magencyacro','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_type')->orderBy('projects.project_projectid','desc')->sortable(['project_projectid'])->get();

        $organization_map = DB::table('projects')->get();

        return view('frontend.projectcategory', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'allprojects', 'project_name', 'organization_map'));
    }
}
