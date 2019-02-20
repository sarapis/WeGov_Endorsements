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
use App\Models\Contact;
use App\Models\Greenbook;
use App\Models\Campaign;
use App\Models\Election;
use App\Models\Endorsement;
use App\Models\Politician;
use App\Models\Information;
use App\Models\EntityOrganization;
use App\Models\PoliticianOrganization;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $peoples = GreenBook::leftjoin('organizations', 'greenbook.organization_code', '=', 'organizations.organizations_id')->select('greenbook.*', 'organizations.organizations_id as organizations_id', 'organizations.name as organization_name')->orderBy('first_name', 'asc')->paginate(16);
        
       
        return view('frontend.peoples', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'peoples', 'organization', 'organization_type', 'taxonomy_lists', 'organization_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find($people_id)
    {
        
        // $peopleid= Contact::where('name','=',$people_id)->first()->contact_id;

        // $people = Contact::where('contact_id','=',$peopleid)->leftjoin('organizations', 'contacts.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('address', 'contacts.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->leftjoin('phones', 'contacts.phone', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('contacts.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), 'address.*', DB::raw('organizations.name as organization_name'), DB::raw('organizations.organizations_id as organizations_id'))->first();

        $people = Greenbook::where('id', '=', $people_id)->first();

        return view('frontend.people', compact('people'));
    }

    // public function organization_find($id, $people_id)
    // {
    //     $contact = GreenBook::where('id', $people_id)->first();
    //     if(isset($contact->organizations->name)) {
    //         $contact->organization_name = $contact->organizations->name;
    //     } else {
    //         $contact->organization_name = '';
    //     }

    //     $organization = Organization::where('organizations_id','=',$contact->organization_code)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();

    //     $entity = EntityOrganization::where('types', '=', $organization->type)->first();
    //     // dd($organization, $contact->organization_code);

    //     // $peopleid= Contact::where('contact_id','=',$id)->first()->contact_id;

    //     // $people = Contact::where('contact_id','=',$peopleid)->leftjoin('organizations', 'contacts.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('address', 'contacts.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->leftjoin('phones', 'contacts.phone', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('contacts.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), 'address.*', DB::raw('organizations.name as organization_name'), DB::raw('organizations.organizations_id as organizations_id'))->first();
    //     // dd($people);

    //     $people = Greenbook::where('id', $people_id)->first();
    //     // dd($people, $firstName, $lastName);
        
    //     $organization_map = DB::table('greenbook')->where('greenbook.id','=', $people_id)->leftjoin('services_organizations', 'greenbook.organization_code', 'like', DB::raw("concat('%', services_organizations.organization_x_id, '%')"))->leftjoin('locations', 'services_organizations.organization_locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->select('services_organizations.*', 'locations.*', 'address.*')->groupBy('services_organizations.id')->get();
    //     // dd($organization_map);
    //     // $people_services = Contact::where('contact_id','=', $contact_id)->leftjoin('services', 'contacts.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('services.*')->leftjoin('phones', 'services.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->select('services.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'))->groupBy('services.id')->get();
        
        
    //     $campaingn = [];
    //     $endorsement = [];
    //     if (isset($contact->getPoliticianOrganizations->recordid) &&$contact->getPoliticianOrganizations->recordid) {
    //         $campaingn = Campaign::where('office', $contact->getPoliticianOrganizations->recordid)->get();
    //         foreach ($campaingn as $key => $value) {
    //             // dd($value, $value->getElection, $value->getParties);
    //             $value->election = $value->getElection ? $value->getElection->name : null;
    //             $value->parties = $value->getParties ? $value->getParties->name : null;
    //             $value->office = $contact->getPoliticianOrganizations->organization;
    //             $value->endorsements = $value->getElection ? $value->getElection->endorsements : null;
    //         }
    //     }

    //     $years = Information::select('reporting_year')->groupBy('reporting_year')->get();
    //     $information = [];

    //     $realYear = [];
    //     foreach ($years as $key => $value) {
    //         $realYear[$value->reporting_year]['cityPosition'] = \DB::table('politicians')->join('city_positions', 'politicians.recordid', '=', 'city_positions.politician')->where('city_positions.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['otherIncome'] = \DB::table('politicians')->join('noncity_income', 'politicians.recordid', '=', 'noncity_income.politician')->where('noncity_income.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['debts'] = \DB::table('politicians')->join('money', 'politicians.recordid', '=', 'money.politician')->where('money.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['realEstate'] = \DB::table('politicians')->join('real_estate', 'politicians.recordid', '=', 'real_estate.politician')->where('real_estate.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['securities'] = \DB::table('politicians')->join('securities', 'politicians.recordid', '=', 'securities.politician')->where('securities.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['trust'] = \DB::table('politicians')->join('trust', 'politicians.recordid', '=', 'trust.politician')->where('trust.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['relatives'] = \DB::table('politicians')->join('relatives', 'politicians.recordid', '=', 'relatives.politician')->where('relatives.reporting_year', $value->reporting_year)->paginate(10);
            
    //     }


    //     // $esr = Endorsement::join('politician_organizations', 'endorsements.organizations', '=', 'politician_organizations.recordid')->get();
    //     // dd($esr);
    //     return view('frontend.organization_people', compact('organization', 'people','people_services', 'organization_map', 'greenbook_name', 'contact', 'realYear', 'campaingn', 'entity'));
    // }

    // public function find($id)
    // {
    //     $contact = GreenBook::where('id', $id)->first();
    //     if(isset($contact->organizations->name)) {
    //         $contact->organization_name = $contact->organizations->name;
    //     } else {
    //         $contact->organization_name = '';
    //     }

    //     $organization = Organization::where('organizations_id','=',$contact->organization_code)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();


    //     // dd($organization, $contact->organization_code);

    //     // $peopleid= Contact::where('contact_id','=',$id)->first()->contact_id;

    //     // $people = Contact::where('contact_id','=',$peopleid)->leftjoin('organizations', 'contacts.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('address', 'contacts.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->leftjoin('phones', 'contacts.phone', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('contacts.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), 'address.*', DB::raw('organizations.name as organization_name'), DB::raw('organizations.organizations_id as organizations_id'))->first();
    //     // dd($people);

    //     $people = Greenbook::where('id', $id)->first();
    //     // dd($people, $firstName, $lastName);
        
    //     $organization_map = DB::table('greenbook')->where('greenbook.id','=', $id)->leftjoin('services_organizations', 'greenbook.organization_code', 'like', DB::raw("concat('%', services_organizations.organization_x_id, '%')"))->leftjoin('locations', 'services_organizations.organization_locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->select('services_organizations.*', 'locations.*', 'address.*')->groupBy('services_organizations.id')->get();
    //     // dd($organization_map);
    //     // $people_services = Contact::where('contact_id','=', $contact_id)->leftjoin('services', 'contacts.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('services.*')->leftjoin('phones', 'services.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->select('services.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'))->groupBy('services.id')->get();
        
        
    //     $campaingn = [];
    //     $endorsement = [];
    //     if (isset($contact->getPoliticianOrganizations->recordid) &&$contact->getPoliticianOrganizations->recordid) {
    //         $campaingn = Campaign::where('office', $contact->getPoliticianOrganizations->recordid)->get();
    //         foreach ($campaingn as $key => $value) {
    //             // dd($value, $value->getElection, $value->getParties);
    //             $value->election = $value->getElection ? $value->getElection->name : null;
    //             $value->parties = $value->getParties ? $value->getParties->name : null;
    //             $value->office = $contact->getPoliticianOrganizations->organization;
    //             $value->endorsements = $value->getElection ? $value->getElection->endorsements : null;
    //         }
    //     }

    //     $years = Information::select('reporting_year')->groupBy('reporting_year')->get();
    //     $information = [];

    //     $realYear = [];
    //     foreach ($years as $key => $value) {
    //         $realYear[$value->reporting_year]['cityPosition'] = \DB::table('politicians')->join('city_positions', 'politicians.recordid', '=', 'city_positions.politician')->where('city_positions.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['otherIncome'] = \DB::table('politicians')->join('noncity_income', 'politicians.recordid', '=', 'noncity_income.politician')->where('noncity_income.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['debts'] = \DB::table('politicians')->join('money', 'politicians.recordid', '=', 'money.politician')->where('money.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['realEstate'] = \DB::table('politicians')->join('real_estate', 'politicians.recordid', '=', 'real_estate.politician')->where('real_estate.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['securities'] = \DB::table('politicians')->join('securities', 'politicians.recordid', '=', 'securities.politician')->where('securities.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['trust'] = \DB::table('politicians')->join('trust', 'politicians.recordid', '=', 'trust.politician')->where('trust.reporting_year', $value->reporting_year)->paginate(10);

    //         $realYear[$value->reporting_year]['relatives'] = \DB::table('politicians')->join('relatives', 'politicians.recordid', '=', 'relatives.politician')->where('relatives.reporting_year', $value->reporting_year)->paginate(10);
            
    //     }


    //     // $esr = Endorsement::join('politician_organizations', 'endorsements.organizations', '=', 'politician_organizations.recordid')->get();
    //     // dd($esr);
    //     return view('frontend.people', compact('organization', 'people','people_services', 'organization_map', 'greenbook_name', 'contact', 'realYear', 'campaingn'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function organizationtypefind($id)
    {

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $peoples = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->where('organizations.name', '=', $id)->select('contacts.*', 'organizations.organizations_id as organizations_id', 'organizations.name as organization_name')->sortable()->paginate(25);
        $organization = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->select('organizations.name as organization_name')->distinct()->get(['organization_name']);
        $organization_type=$id;
        return view('frontend.peoples', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'peoples', 'organization', 'organization_type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
