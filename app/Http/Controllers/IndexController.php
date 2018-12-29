<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Logic\User\UserRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\About;
use App\Models\Data;
use App\Models\Law;
use App\Models\Taxonomy;
use App\Models\Service;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Project;
use App\Services\Numberformat;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $post;


    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function index()
    {
        // return $tree;
        //return view('files.treeview',compact('tree'));
        $posts = $this->post->first();
        $quantity_organizations = DB::table('organizations')->count();
        $budget = DB::table('expenses')->sum('year1_forecast');
        $budgetclass = new Numberformat();
        $budgets = $budgetclass->custom_number_format($budget, 1);
        $quantity_services = DB::table('services')->count();
        $quantity_project = DB::table('projects')->count();
        $quantity_projects = $budgetclass->custom_number_format($quantity_project, 2);
        $total_project_cost = DB::table('agencies')->sum('total_project_cost');
        $capital=$budgetclass->custom_number_format($total_project_cost, 1);

        return view('frontend.home', compact('posts', 'quantity_organizations', 'budgets', 'quantity_services', 'quantity_project', 'capital'));
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function about()

    {
        // return $tree;
        //return view('files.treeview',compact('tree'));
        $abouts = DB::table('abouts')->first();
        $service_name = '&nbsp;';
        $location_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $service_type_name = '&nbsp;';
        $filter = collect([$service_type_name, $location_name, $organization_name, $service_name]);
        return view('frontend.about', compact('abouts','taxonomies','allTaxonomies','servicetypes','projecttypes','organizationtypes', 'taxonomys','filter'));
    }


    public function get_involved()

    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);
        // return $tree;
        // return $tree;
        //return view('files.treeview',compact('tree'));
        $involves = DB::table('involves')->first();
        $service_name = '&nbsp;';
        $location_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $service_type_name = '&nbsp;';
        $filter = collect([$service_type_name, $location_name, $organization_name, $service_name]);
        return view('frontend.get', compact('involves','taxonomies','allTaxonomies','servicetypes','projecttypes','organizationtypes', 'taxonomys','filter'));
    }

    public function find(Request $request)
    {
        $find = $request->input('find');

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $find_organizations= DB::table('organizations')->where('name', 'like', '%'.$find.'%')->orwhere('description', 'like', '%'.$find.'%')->get();
        $count_organizations = DB::table('organizations')->where('name', 'like', '%'.$find.'%')->orwhere('description', 'like', '%'.$find.'%')->count();
        $find_services= DB::table('services')->where('name', 'like', '%'.$find.'%')->orwhere('description', 'like', '%'.$find.'%')->get();
        $count_services = DB::table('services')->where('name', 'like', '%'.$find.'%')->orwhere('description', 'like', '%'.$find.'%')->count();
        $find_projects= DB::table('projects')->where('project_projectid', 'like', '%'.$find.'%')->orwhere('project_description', 'like', '%'.$find.'%')->get();
        $count_projects = DB::table('projects')->where('project_projectid', 'like', '%'.$find.'%')->orwhere('project_description', 'like', '%'.$find.'%')->count();
        $find_peoples = DB::table('contacts')->where('name', 'like', '%'.$find.'%')->orwhere('office_title', 'like', '%'.$find.'%')->get();
        $count_peoples = DB::table('contacts')->where('name', 'like', '%'.$find.'%')->orwhere('office_title', 'like', '%'.$find.'%')->count();
        return view('frontend.find', compact('servicetypes','projecttypes','organizationtypes', 'filter','find_organizations', 'find_services', 'find_projects', 'find_peoples', 'count_organizations', 'count_services', 'count_projects', 'count_peoples', 'find'));

    }

    public function data()
    {
        $datas = Data::first();

        return view('frontend.data', compact('datas'));
    }

    public function Law()
    {
        $laws = Law::first();

        return view('frontend.laws', compact('laws'));
    }
}
