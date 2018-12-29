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
use App\Models\Detail;
use App\Models\Program;
use App\Models\Contact;

use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class ServiceController extends Controller
{
    /**
     * Show the form for creating a new resource.
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

        $taxonomies = Taxonomy::all();
        $services_organizations = DB::table('services_organizations')->get();

        $organization_services = Service::leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->select('services.*', DB::raw('group_concat(services_phones.services_phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'))->groupBy('services.id')->paginate(10);

        $organization_map = DB::table('services_organizations')->leftjoin('locations', 'services_organizations.organization_locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('services_address', 'locations.address', 'like', DB::raw("concat('%', services_address.address_recordid, '%')"))->leftjoin('agencies', 'services_organizations.organization_recordid', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('projects', 'agencies.projects', 'like', DB::raw("concat('%', projects.project_recordid, '%')"))->groupBy('projects.project_recordid')->select('services_organizations.*', 'locations.*', 'projects.*', 'services_address.*')->groupBy('locations.id')->get();

        return view('frontend.services', compact('taxonomies', 'services_organizations', 'organizations_services', 'organization_services', 'organization_map'));
    }

    public function filter(Request $request)
    {
        $ids = $request->organization_value;

        $taxonomies = $request->taxonomy_value;
        // var_dump($taxonomies);
        // exit(); 
        $check = 0;
        if(isset($ids[0])){
            $organization_services = Service::whereIn('organization',$ids);
            $check = 1;
        }
        if(isset($taxonomies[0])){
            if($check == 0)
                $organization_services = Service::where('taxonomy',$taxonomies[0]);
            else
                $organization_services = $organization_services->where(function ($query) use($taxonomies) {
                for($i = 0; $i < count($taxonomies); $i++)
                    $query->orwhere('taxonomy', 'like', '%'.$taxonomies[$i].'%');
            });
            $check = 1;

        }

        if($check == 1)
            $organization_services = $organization_services->leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->groupBy('services.id')->get();
        else
            $organization_services =  Service::leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->groupBy('services.id')->get();

        $organization_map = DB::table('services_organizations')->leftjoin('locations', 'services_organizations.organization_locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('services_address', 'locations.address', 'like', DB::raw("concat('%', services_address.address_recordid, '%')"))->leftjoin('agencies', 'services_organizations.organization_recordid', 'like', DB::raw("concat('%', agencies.magency, '%')"))->leftjoin('projects', 'agencies.projects', 'like', DB::raw("concat('%', projects.project_recordid, '%')"))->groupBy('projects.project_recordid')->select('services_organizations.*', 'locations.*', 'projects.*', 'services_address.*')->groupBy('locations.id')->get();

        return view('frontend.services_filter', compact('organization_services', 'organization_map'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function servicefind($id)
    {

        $service = Service::where('name','=',$id)->first();

        $servicename = Service::where('name','=', $id)->value('name');
        $service_organization = Service::where('name','=', $id)->value('organization');

        $service_taxonomy = Service::where('name','=', $id)->value('taxonomy');
        $service_contact = Service::where('name','=', $id)->value('contacts');
        $service_map = DB::table('services')->where('services.name','=',$id)->leftjoin('locations', 'services.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('services_address', 'locations.address', 'like', DB::raw("concat('%', services_address.address_recordid, '%')"))->get();

        $organization = DB::table('services_organizations')->where('organization_recordid', '=', $service_organization)->value('organization_name');

        $organization_x_id = DB::table('services_organizations')->where('organization_recordid', '=', $service_organization)->value('organization_x_id');

        $taxonomy = Taxonomy::where('taxonomy_id', '=', $service_taxonomy)->select('taxonomy_id', 'name')->first();
        $contacts = Contact::where('contact_id', '=', $service_contact)->value('name');

        
        $service_details = DB::table('services')->where('name', '=', $id)->leftjoin('details', 'services.details', 'like', DB::raw("concat('%', details.detail_id, '%')"))->select('details.value', 'details.detail_type')->get();
 
        return view('frontend.service', compact('taxonomys','service_name','service','organization', 'organization_x_id', 'program','taxonomy', 'contacts', 'service_map', 'service_details','servicename'))->render();
    }

    public function service($id)
    {

        $service = Service::where('name','=',$id)->first();

        $servicename = Service::where('name','=', $id)->value('name');
        $service_organization = Service::where('name','=', $id)->value('organization');

        $service_taxonomy = Service::where('name','=', $id)->value('taxonomy');
        $service_contact = Service::where('name','=', $id)->value('contacts');
        $service_map = DB::table('services')->where('services.name','=',$id)->leftjoin('locations', 'services.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('services_address', 'locations.address', 'like', DB::raw("concat('%', services_address.address_recordid, '%')"))->get();

        $organization = DB::table('services_organizations')->where('organization_recordid', '=', $service_organization)->value('organization_name');

        $organization_x_id = DB::table('services_organizations')->where('organization_recordid', '=', $service_organization)->value('organization_x_id');

        $taxonomy = Taxonomy::where('taxonomy_id', '=', $service_taxonomy)->select('taxonomy_id', 'name')->first();
        $contacts = Contact::where('contact_id', '=', $service_contact)->value('name');

        
        $service_details = DB::table('services')->where('name', '=', $id)->leftjoin('details', 'services.details', 'like', DB::raw("concat('%', details.detail_id, '%')"))->select('details.value', 'details.detail_type')->get();

        $taxonomies = Taxonomy::all();
        $services_organizations = DB::table('services_organizations')->get();
 
        return view('frontend.service1', compact('taxonomys','service_name','service','organization', 'organization_x_id','program', 'taxonomy', 'contacts', 'service_map', 'service_details','servicename', 'taxonomies', 'services_organizations'));
    }

    public function find($id, $service_id)
    {
        $organization = Organization::where('organizations_id','=',$id)->leftjoin('tags', 'organizations.tags', 'like', DB::raw("concat('%', tags.tag_id, '%')"))->select('organizations.*', 'organizations.description as organization_description', DB::raw('group_concat(DISTINCT(tags.tag_name)) as tag_names'))->groupBy('organizations.organization_id')->first();

        $service = Service::where('name','=',$service_id)->first();

        $serviceid = $service->service_id;

        $servicename = Service::where('name','=', $service_id)->value('name');
        $service_organization = Service::where('name','=', $service_id)->value('organization');

        $service_taxonomy = Service::where('name','=', $service_id)->value('taxonomy');
        $service_contact = Service::where('name','=', $service_id)->value('contacts');
        $service_map = DB::table('services')->where('service_id','=',$serviceid)->leftjoin('locations', 'services.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();

        // $organization = DB::table('services_organizations')->where('organization_x_id', '=', $service_organization)->value('organization_name');

        $taxonomy = Taxonomy::where('taxonomy_id', '=', $service_taxonomy)->select('taxonomy_id', 'name')->first();
        $contacts = Contact::where('contact_id', '=', $service_contact)->value('name');

        
        $service_details = DB::table('services')->where('name', '=', $service_id)->leftjoin('details', 'services.details', 'like', DB::raw("concat('%', details.detail_id, '%')"))->select('details.value', 'details.detail_type')->get();
 
        return view('frontend.organization_service', compact('organization', 'taxonomys','service_name','service','organization','program','taxonomy', 'contacts', 'service_map', 'service_details','servicename'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $find = $request->search_service;

        $organization_services = Service::where('name', 'like', '%'.$find.'%')
            ->orwhere('description', 'like', '%'.$find.'%')->get();

        return view('frontend.services_filter', compact('organization_services'))->render();
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
