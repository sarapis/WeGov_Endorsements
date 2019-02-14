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
use App\Models\Agency;
use App\Models\Address;
use App\Models\Taxonomy;
use App\Models\Service;
use App\Models\Location;
use App\Models\Project;
use App\Models\Greenbook;
use App\Models\Organization;
use App\Models\Tag;
use App\Models\EntityOrganization;
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

      

        $types = Organization::distinct()->get(['type']);
        $tags = Tag::all();

        $organizations = Organization::where('type', '=', 'City Agency')->get();
        return view('frontend.organizations', compact('types', 'tags','organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find($id)
    {   
        $organization_type = $organization = Organization::where('organizations_id','=',$id)->first()->type;
        $organizations = Agency::orderBy('magencyacro', 'asc')->get();

        $original_organization = Organization::where('organizations_id','=',$id)->first();
        $original_agency = DB::table('agencies')->where('magency','=',$id)->first();

        // var_dump($organization_services);
        // exit();

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->leftjoin('phones', 'organizations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('address', 'organizations.main_address', '=', 'address.address_id')->select('organizations.*', 'organizations.description as organization_description', 'agencies.*', 'phones.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets', 'address.*'))->groupBy('organizations.organization_id')->first();


        $organizations_services =DB::table('services_organizations')->where('organization_x_id','like', '%'.$id.'%')->first();

        $budgetclass = new Numberformat();

        $organization->total_project_cost=$budgetclass->custom_number_format($organization->total_project_cost, 1);
        $organization->expenses_budgets=$budgetclass->custom_number_format($organization->expenses_budgets, 1);

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();  

        return view('frontend.organization', compact('organization', 'organizations_services', 'original_organization', 'organization_type', 'entity'));
    }

    public function projects($id)
    {
        $organization = Organization::where('organizations_id','=',$id)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();
        $agency_recordid = Agency::where('magency', '=', $id)->first()->agency_recordid;
        

        $organization_projects = Project::where('project_managingagency', '=', $agency_recordid)->paginate(20);

        $organization_map = DB::table('services_organizations')->where('organization_x_id','=', $id)->leftjoin('locations', 'services_organizations.organization_locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('agencies', 'services_organizations.organization_recordid', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('projects', 'agencies.projects', 'like', DB::raw("concat('%', projects.project_recordid, '%')"))->groupBy('projects.project_recordid')->select('services_organizations.*', 'locations.*', 'projects.*')->groupBy('locations.id')->get();

        $entity = EntityOrganization::where('types', '=', $organization->type)->first(); 

        return view('frontend.organization_projects', compact('organization','organization_projects', 'organization_map', 'entity'));
    }

    public function services($id)
    {
        $organization = Organization::where('organizations_id','=',$id)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();

        $organizations_services =DB::table('services_organizations')->where('organization_x_id','like', '%'.$id.'%')->value('organization_name');

        $organization_services = Organization::where('organizations_id','=', $id)->leftjoin('services_organizations', 'organizations.organizations_id', 'like', DB::raw("concat('%', services_organizations.organization_x_id, '%')"))->leftjoin('services', 'services_organizations.organization_services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('services.*')->leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->select('services.*', DB::raw('group_concat(services_phones.services_phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'))->groupBy('services.id')->get();

        $organization_map = DB::table('services_organizations')->where('organization_x_id','=', $id)->leftjoin('locations', 'services_organizations.organization_locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('services_address', 'locations.address', 'like', DB::raw("concat('%', services_address.address_recordid, '%')"))->leftjoin('agencies', 'services_organizations.organization_recordid', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('projects', 'agencies.projects', 'like', DB::raw("concat('%', projects.project_recordid, '%')"))->groupBy('projects.project_recordid')->select('services_organizations.*', 'locations.*', 'projects.*', 'services_address.*')->groupBy('locations.id')->get();

        $entity = EntityOrganization::where('types', '=', $organization->type)->first(); 

        return view('frontend.organization_services', compact('organization', 'organizations_services', 'organization_services', 'organization_map', 'entity'))->render();
    }

    public function money($id)
    {   
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;
             

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->leftjoin('phones', 'organizations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('address', 'organizations.main_address', '=', 'address.address_id')->select('organizations.*', 'organizations.description as organization_description', 'agencies.*', 'phones.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets', 'address.*'))->groupBy('organizations.organization_id')->first();

        $budgetclass = new Numberformat();
        $capital_budget = $organization->total_project_cost;
        $expense_budget = $organization->expenses_budgets;
        $organization->total_project_cost=$budgetclass->custom_number_format($organization->total_project_cost, 1);
        $organization->expenses_budgets=$budgetclass->custom_number_format($organization->expenses_budgets, 1);

        // var_dump($organization_services);
        // exit();

        $organization_expenses = Organization::where('organizations_id','=', $id)->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->groupBy('expenses.expenses_id')->orderBy('expenses.line_number')->get();

        $expenses_sum = Organization::where('organizations_id','=', $id)->leftjoin('agencies', 'organizations.organizations_id', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->select(DB::raw('sum(expenses.year1_forecast) as expenses_year1'), DB::raw('sum(expenses.year2_estimate) as expenses_year2'), DB::raw('sum(expenses.year3_estimate) as expenses_year3'))->first();  

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();


        return view('frontend.organization_money', compact('organization', 'organization_expenses', 'expenses_sum', 'capital_budget', 'expense_budget', 'organization_type', 'entity'));
    }

    public function peoples($id)
    {
        $organization = Organization::where('organizations_id','=',$id)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();

        $organization_peoples = Greenbook::where('organization_code', '=', $id)->get();

        $entity = EntityOrganization::where('types', '=', $organization->type)->first();

        return view('frontend.organization_peoples', compact('organization', 'organization_peoples', 'entity'))->render();
    }


    public function laws($id)
    {
        $organization = Organization::where('organizations_id','=',$id)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();
        $entity = EntityOrganization::where('types', '=', $organization->type)->first();

        return view('frontend.organization_laws', compact('organization', 'entity'));
    }


    public function legislation($id)
    {
        $organization = Organization::where('organizations_id','=',$id)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();

        return view('frontend.organization_legislation', compact('organization'));
    }

    public function endorsements($id)
    {
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;
        $organizations = Agency::orderBy('magencyacro', 'asc')->get();

        $original_organization = Organization::where('organizations_id','=',$id)->first();
        $original_agency = DB::table('agencies')->where('magency','=',$id)->first();

        // var_dump($organization_services);
        // exit();

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->leftjoin('phones', 'organizations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('address', 'organizations.main_address', '=', 'address.address_id')->select('organizations.*', 'organizations.description as organization_description', 'agencies.*', 'phones.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets', 'address.*'))->groupBy('organizations.organization_id')->first();

        // var_dump($organization->total_project_cost);
        // exit();
        $budgetclass = new Numberformat();

        $organization->total_project_cost=$budgetclass->custom_number_format($organization->total_project_cost, 1);
        $organization->expenses_budgets=$budgetclass->custom_number_format($organization->expenses_budgets, 1);

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();


        return view('frontend.organization_endorsements', compact('organization', 'organization_expenses', 'organization_map', 'expenses_sum', 'original_organization', 'organization_type', 'entity'));

    }

    public function candidates($id)
    {
        $organization_type = $organization = Organization::where('organizations_id','=',$id)->first()->type;
        $organizations = Agency::orderBy('magencyacro', 'asc')->get();

        $original_organization = Organization::where('organizations_id','=',$id)->first();
        $original_agency = DB::table('agencies')->where('magency','=',$id)->first();

        // var_dump($organization_services);
        // exit();

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->leftjoin('phones', 'organizations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('address', 'organizations.main_address', '=', 'address.address_id')->select('organizations.*', 'organizations.description as organization_description', 'agencies.*', 'phones.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets', 'address.*'))->groupBy('organizations.organization_id')->first();

        // var_dump($organization->total_project_cost);
        // exit();
        $budgetclass = new Numberformat();

        $organization->total_project_cost=$budgetclass->custom_number_format($organization->total_project_cost, 1);
        $organization->expenses_budgets=$budgetclass->custom_number_format($organization->expenses_budgets, 1);

        $agency_map = Address::where('organizations','=', $original_organization->organization_id)->first();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();


        return view('frontend.organization_candidates', compact('organization', 'organization_expenses', 'organization_map', 'expenses_sum', 'original_organization', 'organization_type', 'agency_map', 'entity'));

    }

    public function requests($id)
    {
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;
        $agency_recordid = Agency::where('magency', '=', $id)->first()->agency_recordid;

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();    

        $requests = DB::table('requests')->where('community_board', '=', $agency_recordid)->get();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();

        return view('frontend.organization_requests', compact('organization', 'organization_type', 'requests', 'entity'));

    } 

    public function requests_details($id, $tracking_code)
    {
        $organization_type = $organization = Organization::where('organizations_id','=',$id)->first()->type;
        $community_board = Agency::where('magency', '=', $id)->first()->magency;

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();

        $request = DB::table('requests')->where('tracking_code', '=', $tracking_code)->first();

        $responsible_agency = Agency::where('agency_recordid', '=', $request->responsible_agency)->first();

        $agency_map = Address::where('organizations','=', $request->responsible_agency)->first();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();


        return view('frontend.organization_requests_details', compact('organization', 'organization_type', 'community_board', 'request', 'responsible_agency', 'agency_map', 'entity'));

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $find = $request->search_agency;

        $organizations = Organization::groupBy('organizations.organization_id')->where('organizations.name', 'like', '%'.$find.'%')
            ->orwhere('organizations.description', 'like', '%'.$find.'%')->sortable(['expenses_budgets'])->get();

        return view('frontend.organization_filter', compact('organizations'))->render();
    }

    public function filter(Request $request)
    {
        $types = $request->organization_type;
        $tags = $request->organization_tag;
        // $find = $request->val; 
        $check = 0;
        if(isset($types[0])){
            $organizations = Organization::whereIn('type',$types);
            $check = 1;
        }
        if(isset($tags[0])){
            if($check == 0)
               $organizations = Organization::where('tags', 'like', '%'.$tags[0].'%');
            else
                // $organizations = $organizations->whereIn('tags', $tags);
            $organizations = $organizations->where(function ($query) use($tags) {
                // $query = $query->where('tags', 'like', '%'.$tags[0].'%');
                for($i = 0; $i < count($tags); $i++)
                    $query->orwhere('tags', 'like', '%'.$tags[$i].'%');
            });

            $check = 1;

        }
      
        if($check == 1)
            $organizations = $organizations->get();
        else
            $organizations = Organization::all();

        return view('frontend.organization_filter', compact('organizations'))->render();
    }
    
}

