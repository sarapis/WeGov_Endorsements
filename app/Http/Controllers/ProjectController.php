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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
//use Cornford\Googlmapper\Mapper;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

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
        //$pros = $this->pro->first();
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $allprojects = Project::leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id','projects.project_recordid','projects.project_projectid','agencies.magency','agencies.magencyacro','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_type')->sortable(['project_projectid'])->paginate(25);
        $projecttypes = DB::table('projects')-> distinct()-> get(['project_type']);
        $projecttype = '';
        return view('frontend.projects', compact('servicetypes','projecttypes','organizationtypes','filter', 'allprojects','projecttypes','projecttype'));
    }


    public function projectfind($id)
    {   
        //$pros = $this->pro->first();

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $project = DB::table('projects')->where('project_recordid', $id)->leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.project_projectid', 'agencies.magency', 'agencies.magencyacro', 'agencies.magencyname','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_citycost','projects.project_noncitycost','projects.project_type','projects.project_lat','projects.project_long')->first();
        $lat = DB::table('projects')->where('project_recordid', $id)-> value('project_lat');
        $long = DB::table('projects')->where('project_recordid', $id)-> value('project_long');
        Mapper::map($lat, $long, ['zoom' => 15]);
        $commitments = DB::table('commitments')->where('projectid', $id)->get();
        return view('frontend.profile', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'commitments','project'));
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
