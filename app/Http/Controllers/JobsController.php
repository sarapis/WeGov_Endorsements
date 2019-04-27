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
use App\Models\EntityOrganization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
//use Cornford\Googlmapper\Mapper;

class jobsController extends Controller
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

    public function index()
    {
        $project_types = Project::distinct()->get(['project_type']);
        $organizations = Agency::whereNotNull('projects')->orderBy('magencyacro', 'asc')->get();

        $allprojects = Project::leftJoin('agencies', 'projects.project_managingagency', '=', 'agency_recordid')->select('projects.id','projects.project_recordid','projects.project_projectid','agencies.magency','agencies.magencyacro','projects.project_description','projects.project_commitments','projects.project_totalcost','projects.project_type')->orderBy('project_projectid', 'asc')->paginate(20);

        $projects = Project::all();

        return view('frontend.jobs', compact('project_types', 'organizations', 'allprojects', 'projects'));
    }

    
}
