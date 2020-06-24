<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Endorsement;
use App\Models\Politician;
use App\Models\PoliticianOrganization;
use App\Models\Election;
use App\Models\Campaign;
use App\Models\Requests;
use App\Models\EntityOrganization;
use App\Models\Information;
use App\Models\Question;
use App\Models\Position;
use App\Models\Noncity_income;
use App\Models\Money;
use App\Models\Realestate;
use App\Models\Securities;
use App\Models\Trust;
use App\Models\Relatives;
use App\Models\Kpi;
use App\Models\Job;
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
        $types = Organization::distinct()->orderBy('type')->get(['type']);
        $tags = Tag::orderBy('tag_name')->get();
        $organizations = Organization::where('type', '=', 'City Agency')->get();
        return view('frontend.organizations', compact('types', 'tags','organizations'));
    }

    public function endorsers()
    {
        $types = PoliticianOrganization::distinct()->where('type', '!=', 'Elected Office')->orderBy('type')->get(['type']);
        $tags = Tag::orderBy('tag_name')->get();
        $organizations = PoliticianOrganization::where('type', '!=', 'Elected Office')->get();
        return view('frontend.organizations_endorsers', compact('types', 'tags','organizations'));
    }

    public function offices()
    {
        $types = Organization::distinct()->orderBy('type')->get(['type']);
        $tags = Tag::orderBy('tag_name')->get();
        $organizations = Organization::where('type', '=', 'Elected Office')->get();
        return view('frontend.organizations', compact('types', 'tags','organizations'));
    }

    public function candidates_all()
    {
        $types = Organization::distinct()->orderBy('type')->get(['type']);
        $tags = Tag::orderBy('tag_name')->get();
        $candidates = Politician::orderBy('name')->get();
        return view('frontend.organization_candidates_all', compact('types', 'tags','candidates'));
    }

    public function allpost(Request $request)
    {
        

        $types = Organization::distinct()->orderBy('type')->get(['type']);
        $tags = Tag::orderBy('tag_name')->get();

        $post_type = $request->input('post_type');
        $post_value = $request->input('post_value');
        // var_dump($post_value, $post_type);
        // exit();

        if($post_type == 'type'){
            $organizations = Organization::where('type', '=', $post_value)->get();
        }
        else{
            $organizations = Organization::where('tags', 'like', '%'.$post_value.'%')->get();
        }

        return view('frontend.organizations', compact('types', 'tags','organizations', 'post_value', 'post_type'));
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

        $agency = Agency::where('magency', '=', $id)->first();

        if($agency)
            $agency_recordid = $agency->agency_recordid;
        else
            $agency_recordid = '';

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->leftjoin('expenses', 'agencies.expenses', 'like', DB::raw("concat('%', expenses.expenses_id, '%')"))->leftjoin('phones', 'organizations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('address', 'organizations.main_address', '=', 'address.address_id')->select('organizations.*', 'organizations.description as organization_description', 'agencies.*', 'phones.*', DB::raw('sum(expenses.year1_forecast) as expenses_budgets', 'address.*'))->groupBy('organizations.organization_id')->first();


        $organizations_services =DB::table('services_organizations')->where('organization_x_id','like', '%'.$id.'%')->first();

        $budgetclass = new Numberformat();

        $organization->total_project_cost=$budgetclass->custom_number_format($organization->total_project_cost, 1);
        $organization->expenses_budgets=$budgetclass->custom_number_format($organization->expenses_budgets, 1);

        $desired_count = Kpi::where('agency_join', '=', $agency_recordid)->whereRaw('desired_direction = trend')->count();

        $undesired_count = Kpi::where('agency_join', '=', $agency_recordid)->whereRaw('desired_direction != trend')->count();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();  

        return view('frontend.organization', compact('organization', 'organizations_services', 'organization_type', 'entity', 'desired_count', 'undesired_count'));
    }

    public function projects($id)
    {
        $organization = Organization::where('organizations_id','=',$id)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();
        
        $agency = Agency::where('magency', '=', $id)->first();

        if($agency)
            $agency_recordid = $agency->agency_recordid;
        else
            $agency_recordid = '';

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

        // var_dump($organization_map);
        // exit();

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
        
        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->groupBy('organizations.organization_id')->first();

        $politician_organization = DB::table('politician_organizations')->where('organizationid', '=', $id)->first();

        if($politician_organization)
            $organization_recordid = $politician_organization->recordid;
        else
            $organization_recordid = '';


        $endorsements = Endorsement::where('organizations', '=', $organization_recordid)->leftjoin('parties', 'endorsements.party','like', DB::raw("concat('%', parties.recordid, '%')"))->select('endorsements.*', DB::raw('group_concat(parties.name) as parties_name'))->groupBy('endorsements.id')->get();
       

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();


        return view('frontend.organization_endorsements', compact('organization', 'organization_type', 'endorsements', 'entity'));

    }

    public function candidates($id)
    {
        $organization_type  = Organization::where('organizations_id','=',$id)->first()->type;
    
        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->groupBy('organizations.organization_id')->first();

        $politician_organization = DB::table('politician_organizations')->where('organizationid', '=', $id)->first();

        $election_2019_recordid = Election::where('id', '=', '1')->first()->recordid;
        $election_2017_recordid = Election::where('year', '=', '2017')->first()->recordid;
        $election_2013_recordid = Election::where('year', '=', '2013')->first()->recordid;

        if(isset($politician_organization))
        {
            // $politicians_2017 = Politician::where('seeking_office', 'like', '%'.$politician_organization->recordid.'%')->where('election_year', 'like', '%'.$election_2017_recordid.'%')->leftjoin('parties', 'politicians.with_parties','like', DB::raw("concat('%', parties.recordid, '%')"))->select('politicians.*', DB::raw('group_concat(parties.name) as parties_name'))->groupBy('politicians.id')->orderBy('politicians.elected_to', 'desc')->get();


            $politicians_2017 = Campaign::where('office', '=', $politician_organization->recordid)->where('election', '=', $election_2017_recordid)->leftjoin('parties', 'campaigns.parties','like', DB::raw("concat('%', parties.recordid, '%')"))->select('campaigns.*', DB::raw('group_concat(parties.name) as parties_name'))->groupBy('campaigns.id')->orderBy('campaigns.winner', 'desc')->get();

            $politicians_2013 = Campaign::where('office', '=', $politician_organization->recordid)->where('election', '=', $election_2013_recordid)->leftjoin('parties', 'campaigns.parties','like', DB::raw("concat('%', parties.recordid, '%')"))->select('campaigns.*', DB::raw('group_concat(parties.name) as parties_name'))->groupBy('campaigns.id')->orderBy('campaigns.winner', 'desc')->get();

            $politicians_2019 = Campaign::where('office', '=', $politician_organization->recordid)->where('election', '=', $election_2019_recordid)->leftjoin('parties', 'campaigns.parties','like', DB::raw("concat('%', parties.recordid, '%')"))->select('campaigns.*', DB::raw('group_concat(parties.name) as parties_name'))->groupBy('campaigns.id')->orderBy('campaigns.winner', 'desc')->get();
        }
        else{
            $politicians_2017 = [];
            $politicians_2013 = [];
            $politicians_2019 = [];
        }


        $endorsements = Endorsement::leftjoin('politician_organizations', 'endorsements.organizations','like', DB::raw("concat('%', politician_organizations.recordid, '%')"))->select('endorsements.*', DB::raw('group_concat(politician_organizations.organization) as organization_name'), DB::raw('group_concat(politician_organizations.organizationid) as organizations_id'))->groupBy('endorsements.id')->get();

        // var_dump($endorsements->organization);
        // exit();


        $entity = EntityOrganization::where('types', '=', $organization_type)->first();


        return view('frontend.organization_candidates', compact('organization', 'organization_type', 'entity', 'politicians_2017', 'politicians_2013', 'politicians_2019', 'endorsements'));

    }

    public function candidates_detail($politician_id)
    {

        // $politician = Politician::find($politician_id);
        $politician = Politician::where('recordid', '=', $politician_id)->first();

        $campaigns = Campaign::where('politician', '=', $politician->recordid)->leftjoin('parties', 'campaigns.parties','like', DB::raw("concat('%', parties.recordid, '%')"))->select('campaigns.*', DB::raw('group_concat(parties.name) as parties_name'))->groupBy('campaigns.id')->get();
        $endorsements = Endorsement::where('candidate_name', '=', $politician->recordid)->get();

        $information_2017 = Information::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->first();

        $information_2016 = Information::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->first();

        
        $questions = Question::orderBy('question_id', 'asc')->get();

        $position_2017 = Position::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->get();
        $position_2016 = Position::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->get();

        $incomes_2017 = Noncity_income::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->get();
        $incomes_2016 = Noncity_income::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->get();

        $depts_2017 = Money::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->get();
        $depts_2016 = Money::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->get();

        $realestates_2017 = Realestate::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->get();
        $realestates_2016 = Realestate::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->get();

        $securities_2017 = Securities::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->get();
        $securities_2016 = Securities::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->get();

        $trusts_2017 = Trust::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->get();
        $trusts_2016 = Trust::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->get();

        $relatives_2017 = Relatives::where('politician', '=', $politician->recordid)->where('reporting_year', '2017')->get();
        $relatives_2016 = Relatives::where('politician', '=', $politician->recordid)->where('reporting_year', '2016')->get();

        return view('frontend.candidate', compact('endorsements', 'politician', 'campaigns', 'endorsements', 'information_2017', 'information_2016', 'questions', 'position_2017', 'position_2016', 'incomes_2017', 'incomes_2016', 'depts_2017',  'depts_2016', 'realestates_2017', 'realestates_2016', 'securities_2017', 'securities_2016', 'trusts_2017', 'trusts_2016', 'relatives_2017', 'relatives_2016'));

    }

    public function requests($id)
    {
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;

        $agency = Agency::where('magency', '=', $id)->first();

        if($agency)
            $agency_recordid = $agency->agency_recordid;
        else
            $agency_recordid = '';

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();    

        $requests = Requests::where('community_board', '=', $agency_recordid)->get();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();

        return view('frontend.organization_requests', compact('organization', 'organization_type', 'requests', 'entity'));

    } 

    public function requests_from($id)
    {
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;

        $agency = Agency::where('magency', '=', $id)->first();

        if($agency)
            $agency_recordid = $agency->agency_recordid;
        else
            $agency_recordid = '';

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();    

        $requests = Requests::where('responsible_agency', '=', $agency_recordid)->get();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();

        return view('frontend.organization_requests_from', compact('organization', 'organization_type', 'requests', 'entity'));

    } 

    public function requests_details($id, $tracking_code)
    {
        $organization_type = $organization = Organization::where('organizations_id','=',$id)->first()->type;
        $community_board = Agency::where('magency', '=', $id)->first()->magency;

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();

        $request = Requests::where('tracking_code', '=', $tracking_code)->first();

        $responsible_agency = Agency::where('agency_recordid', '=', $request->responsible_agency)->first();

        $agency_map = Address::where('organizations','=', $request->responsible_agency)->first();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();


        return view('frontend.organization_requests_details', compact('organization', 'organization_type', 'community_board', 'request', 'responsible_agency', 'agency_map', 'entity'));

    }

    public function indicators($id)
    {
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;

        $agency = Agency::where('magency', '=', $id)->first();

        if($agency)
            $agency_recordid = $agency->agency_recordid;
        else
            $agency_recordid = '';

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();    

        $indicators = Kpi::where('agency_join', '=', $agency_recordid)->get();

        $desired_count = Kpi::where('agency_join', '=', $agency_recordid)->whereRaw('desired_direction = trend')->count();

        $undesired_count = Kpi::where('agency_join', '=', $agency_recordid)->whereRaw('desired_direction != trend')->count();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();

        return view('frontend.organization_indicators', compact('organization', 'organization_type', 'indicators', 'entity', 'desired_count', 'undesired_count'));

    } 

    public function jobs($id)
    {
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;

        $agency = Agency::where('magency', '=', $id)->first();

        if($agency)
            $agency_recordid = $agency->agency_recordid;
        else
            $agency_recordid = '';

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();    

        $jobs = Job::where('organization_code', '=', $id)->get();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();

        return view('frontend.organization_jobs', compact('organization', 'organization_type', 'jobs', 'entity'));

    } 
    
    public function job($id, $job_id)
    {
        $organization_type = Organization::where('organizations_id','=',$id)->first()->type;

        $agency = Agency::where('magency', '=', $id)->first();

        if($agency)
            $agency_recordid = $agency->agency_recordid;
        else
            $agency_recordid = '';

        $organization = Organization::where('organizations_id','=',$id)->leftjoin('agencies', 'organizations.organizations_id', '=', 'agencies.magency')->first();    

        $job = Job::where('organization_code', '=', $id)->where('job_id', '=', $job_id)->first();

        $entity = EntityOrganization::where('types', '=', $organization_type)->first();

        return view('frontend.organization_job', compact('organization', 'organization_type', 'job', 'entity'));

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

    public function search_endorsers(Request $request)
    {
        $find = $request->search_agency;

        $organizations = PoliticianOrganization::where('organization', 'like', '%'.$find.'%')
            ->orwhere('type', 'like', '%'.$find.'%')->orwhere('tags', 'like', '%'.$find.'%')->get();

        return view('frontend.organization_filter_endorsers', compact('organizations'))->render();
    }

    public function search_year(Request $request)
    {
        $year = $request->search_year;
        $candidates = Politician::where('election_year', 'like', '%'.$year.'%')->get();
        return view('frontend.organization_candidates_filter', compact('candidates'))->render();
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


    public function filter_endorsers(Request $request)
    {
        $types = $request->organization_type;
        $tags = $request->organization_tag;

        // $find = $request->val; 
        $check = 0;
        if(isset($types[0])){
            $organizations = PoliticianOrganization::whereIn('type',$types);            
            $check = 1;
        } else {
            if ($types) {
                $organizations = PoliticianOrganization::where('type', '=', $types); 
            }
        }

        if(isset($tags[0])){
            if($check == 0)
               $organizations = PoliticianOrganization::where('tags', 'like', '%'.$tags[0].'%');
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
            $organizations = PoliticianOrganization::all();


        return view('frontend.organization_filter_endorsers', compact('organizations'))->render();
    }
    
}

