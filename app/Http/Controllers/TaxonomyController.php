<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Logic\User\UserRepository;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Models\Service;
use App\Models\Project;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Program;
use App\Models\Detail;
use App\Models\Contact;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class TaxonomyController extends Controller
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
        $taxonomies = Taxonomy::where('parent_name', '=', '')->get();

        $services = Service::all();
        $organizations = Organization::all();
        $projects = Project::all();
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$service_name, $organization_name, $project_name]);
        return view('frontend.taxonomy', compact('services','projects','organizations', 'taxonomys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $services = Service::all();
        $locations = Location::all();
        $taxonomys = Taxonomy::all();
        $organizations = Organization::all();
        $taxonomies = Taxonomy::where('parent_name', '=', '')->get();
        $allTaxonomies = Taxonomy::pluck('name','taxonomy_id')->all();
        // return $tree;
        //return view('files.treeview',compact('tree'));
        $posts = $this->post->first();

        $services = Service::all();
        $organizations = Organization::all();
        $projects = Project::all();
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$service_name, $organization_name, $project_name]);
        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.taxonomies', compact('posts','taxonomies','allTaxonomies','services','projects','organizations', 'taxonomys','filter', 'location_map'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find($id)
    {
        $taxonomy = Taxonomy::where('taxonomy_id','=',$id)->first();

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = Taxonomy::where('taxonomy_id','=',$id)->value('name');
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $taxonomy_map = DB::table('taxonomies')->where('taxonomy_id','=',$id)->leftjoin('services', 'taxonomies.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->leftjoin('locations', 'services.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();

        $taxonomy_services = Taxonomy::where('taxonomy_id','=', $id)->leftjoin('services', 'taxonomies.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('services.*')->leftjoin('organizations', 'services.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('phones', 'services.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('services.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('organizations.name as organization_name'), DB::raw('organizations.organizations_id as organizations_id'))->groupBy('services.id')->get();

        return view('frontend.taxonomy', compact('servicetypes','projecttypes','organizationtypes', 'taxonomys','service_name','service','taxonomy','filter','taxonomy_services', 'taxonomy_map'));
    }

}
