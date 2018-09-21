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

        return view('frontend.projects', compact('project_types', 'organizations', 'allprojects'));
    }

    public function filter(Request $request)
    {
        $ids = $request->organization_value;

        $project_type = $request->project_type;
         
        $check = 0;
        if(isset($ids[0])){
            $allprojects = Project::where('project_managingagency',$ids[0]);
            $count = 0;
            for($i = 1; $i < count($ids); $i++)
                $allprojects = $allprojects->orwhere('project_managingagency',$ids[$i]);
            $check = 1;
        }
        if(isset($project_type[0])){
            if($check == 0)
                $allprojects = Project::where('project_type',$project_type[0]);
            else
                $allprojects = $allprojects->orwhere('project_type',$project_type[0]);
            for($i = 1; $i < count($project_type); $i++)
                $allprojects = $allprojects->orwhere('project_type',$project_type[$i]);
            $check = 1;

        }
        if($check == 1)
            $allprojects = $allprojects->get();
        else
            $allprojects =  Project::all();

        return view('frontend.projects_filter', compact('allprojects'))->render();
    }


    public function search(Request $request)
    {
        $find = $request->search_project;

        $allprojects = Project::where('project_projectid', 'like', '%'.$find.'%')
            ->orwhere('project_description', 'like', '%'.$find.'%')->get();

        return view('frontend.projects_filter', compact('allprojects'))->render();
    }

    public function find($id)
    {   

        $project = DB::table('projects')->where('project_recordid', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long')->first();

        $commitments = DB::table('commitments')->where('projectid', $id)->get();
        return view('frontend.project', compact('commitments','project'))->render();
    }

    //project type find
    public function projecttypefind($id)
    {
        //$pros = $this->pro->first();

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $projecttype = DB::table('projects')->where('project_type', $id)->value('project_type');
        $allprojects = Project::where('project_type', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id','projects.project_recordid','projects.project_projectid', 'agencies.magency', 'agencies.magencyacro','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_type')->orderBy('projects.project_projectid','desc')->sortable(['project_projectid'])->paginate(25);
        $projecttypes = DB::table('projects')-> distinct()-> get(['project_type']);

        return view('frontend.projects', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'allprojects','projecttypes','projecttype'));
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
