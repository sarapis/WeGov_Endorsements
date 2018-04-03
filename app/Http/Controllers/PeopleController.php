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
use App\Models\Location;
use App\Models\Project;
use App\Models\Organization;
use App\Models\Contact;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $peoples = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->select('contacts.*', 'organizations.organizations_id as organizations_id', 'organizations.name as organization_name')->sortable(['name'])->paginate(25);
        $organization = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->select('organizations.name as organization_name')->distinct()->get(['organization_name']);
        $organization_type='';
        return view('frontend.peoples', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'peoples', 'organization', 'organization_type'));
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

        $people = Contact::where('contact_id','=',$id)->leftjoin('organizations', 'contacts.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('address', 'contacts.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->leftjoin('phones', 'contacts.phone', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('contacts.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), 'address.*', DB::raw('organizations.name as organization_name'), DB::raw('organizations.organizations_id as organizations_id'))->first();

        $organization_map = DB::table('contacts')->where('contact_id','=',$id)->leftjoin('organizations', 'contacts.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('locations', 'organizations.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->select('organizations.*', 'locations.*', 'address.*')->groupBy('organizations.id')->get();

        $people_services = Contact::where('contact_id','=', $id)->leftjoin('services', 'contacts.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('services.*')->leftjoin('phones', 'services.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->select('services.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'))->groupBy('services.id')->get();

        return view('frontend.people', compact('servicetypes','projecttypes','organizationtypes', 'people','filter','people_services', 'organization_map'));
    }

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
