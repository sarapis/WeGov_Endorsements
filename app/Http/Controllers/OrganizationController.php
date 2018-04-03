<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

use App\Logic\User\UserRepository;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Models\Service;
use App\Models\Location;
use App\Models\Project;
use App\Models\Organization;
use App\Services\Numberformat;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';
        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes','filter', 'location_map', 'organizations', 'organization_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find($id)
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $original_organization = Organization::where('organizations_id','=',$id)->first();
        $original_agency = DB::table('agencies')->where('magency','=',$id)->first();

        $organization_service =Organization::where('organizations_id','=', $id)->value('services');
        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->leftjoin('phones', 'organizations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('organizations.*', 'organizations.description as organization_description', 'agencies.*', 'phones.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.organization_id')->first();

        // var_dump($organization->total_project_cost);
        // exit();
        $budgetclass = new Numberformat();
        $organization->total_project_cost=$budgetclass->custom_number_format($organization->total_project_cost, 1);
        $organization->expenses_budgets=$budgetclass->custom_number_format($organization->expenses_budgets, 1);

        $organization_map = DB::table('organizations')->where('organizations_id','=', $id)->leftjoin('locations', 'organizations.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('projects', 'agencies.projects', 'like', DB::raw("concat('%', projects.project_recordid, '%')"))->groupBy('projects.project_recordid')->select('organizations.*', 'locations.*', 'projects.*', 'address.*')->groupBy('locations.id')->get();

        $organization_services = Organization::where('organizations_id','=', $id)->leftjoin('services', 'organizations.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('services.*')->leftjoin('phones', 'services.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->select('services.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'))->groupBy('services.id')->get();

        $organization_projects = Organization::where('organizations_id','=', $id)->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('projects', 'agencies.projects', 'like', DB::raw("concat('%', projects.project_recordid, '%')"))->groupBy('projects.project_recordid')->get();

        $organization_peoples = Organization::where('organizations_id','=', $id)->leftjoin('contacts', 'organizations.contacts', 'like', DB::raw("concat('%', contacts.contact_id, '%')"))->groupBy('contacts.contact_id')->get();

        $organization_expenses = Organization::where('organizations_id','=', $id)->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->groupBy('expenses.expenses_id')->orderBy('expenses.line_number')->get();

        $expenses_sum = Organization::where('organizations_id','=', $id)->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select(DB::raw('sum(expenses.year1_forecast) as expenses_year1'), DB::raw('sum(expenses.year2_estimate) as expenses_year2'), DB::raw('sum(expenses.year3_estimate) as expenses_year3'))->first();  


        return view('frontend.organization', compact('servicetypes','projecttypes','organizationtypes','filter', 'organization', 'organization_services', 'organization_projects', 'organization_peoples',  'organization_expenses', 'organization_services_count', 'organization_projects_count', 'organization_peoples_count', 'organization_map', 'expenses_sum', 'organization_service' , 'original_organization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $find = $request->input('find');

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->where('organizations.name', 'like', '%'.$find.'%')
            ->orwhere('organizations.description', 'like', '%'.$find.'%')->sortable(['expenses_budgets'])->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations'));
    }

    public function expensedesc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('expenses_budgets', 'desc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations', 'organization_type'));
    }

    public function expenseasc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('expenses_budgets', 'asc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations', 'organization_type'));
    }

    public function projectsdesc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('total_project_cost', 'desc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map','organizations', 'organization_type'));
    }

    public function projectsasc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('total_project_cost', 'asc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations', 'organization_type'));
    }

    public function servicesdesc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('services_count', 'desc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations', 'organization_type'));
    }

    public function servicesasc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('services_count', 'asc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations', 'organization_type'));
    }

    public function projectdesc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';
 
        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('projects_count', 'desc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations', 'organization_type'));
    }

    public function projectasc()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type='';

        $organizations = Organization::leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->orderBy('projects_count', 'asc')->get();

        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'location_map', 'organizations', 'organization_type'));
    }

    public function category($id)
    {

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = $id;
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $organization_type = $id;
        $organizations = Organization::where('organizations.type', '=', $id)->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select('organizations.*', 'agencies.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets'))->groupBy('organizations.id')->get();

        $organization_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();

        return view('frontend.organizations', compact('servicetypes','projecttypes','organizationtypes','filter', 'organizations','organization_map','organization_name', 'organization_type'));
    }
}
