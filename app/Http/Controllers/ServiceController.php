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
         
        $check = 0;
        if(isset($ids[0])){
            $organization_services = Service::where('organization',$ids[0]);
            $count = 0;
            for($i = 1; $i < count($ids); $i++)
                $organization_services = $organization_services->orwhere('organization',$ids[$i]);
            $check = 1;
        }
        if(isset($taxonomies[0])){
            if($check == 0)
                $organization_services = Service::where('taxonomy',$taxonomies[0]);
            else
                $organization_services = $organization_services->orwhere('taxonomy',$taxonomies[0]);
            for($i = 1; $i < count($taxonomies); $i++)
                $organization_services = $organization_services->orwhere('taxonomy',$taxonomies[$i]);
            $check = 1;

        }
        if($check == 1)
            $organization_services = $organization_services->leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->groupBy('services.id')->get();
        else
            $organization_services =  Service::leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->groupBy('services.id')->get();

        return view('frontend.services_filter', compact('organization_services'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find($id)
    {

        $service = Service::where('service_id','=',$id)->first();

        $servicename = Service::where('service_id','=', $id)->value('name');
        $service_organization = Service::where('service_id','=', $id)->value('organization');

        $service_taxonomy = Service::where('service_id','=', $id)->value('taxonomy');
        $service_contact = Service::where('service_id','=', $id)->value('contacts');
        $service_map = DB::table('services')->where('service_id','=',$id)->leftjoin('locations', 'services.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();

        $organization = DB::table('services_organizations')->where('organization_x_id', '=', $service_organization)->value('organization_name');

        $taxonomy = Taxonomy::where('taxonomy_id', '=', $service_taxonomy)->select('taxonomy_id', 'name')->first();
        $contacts = Contact::where('contact_id', '=', $service_contact)->value('name');

        
        $service_details = DB::table('services')->where('service_id', '=', $id)->leftjoin('details', 'services.details', 'like', DB::raw("concat('%', details.detail_id, '%')"))->select('details.value', 'details.detail_type')->get();
 
        return view('frontend.service', compact('taxonomys','service_name','service','organization','program','taxonomy', 'contacts', 'service_map', 'service_details','servicename'))->render();
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
