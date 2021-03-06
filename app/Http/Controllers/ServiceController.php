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
use App\Models\EntityOrganization;

use Geolocation;
use Geocode;

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

        $organization_services = Service::leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->leftjoin('services_organizations', 'services.organization', '=', 'services_organizations.organization_recordid')->select('services.*', DB::raw('group_concat(services_phones.services_phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'), 'services_organizations.organization_x_id')->groupBy('services.id')->paginate(10);

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
            $organization_services = $organization_services->leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->leftjoin('services_organizations', 'services.organization', '=', 'services_organizations.organization_recordid')->select('services.*', DB::raw('group_concat(services_phones.services_phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'), 'services_organizations.organization_x_id')->groupBy('services.id')->get();
        else
            $organization_services =  Service::leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->leftjoin('services_organizations', 'services.organization', '=', 'services_organizations.organization_recordid')->select('services.*', DB::raw('group_concat(services_phones.services_phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'), 'services_organizations.organization_x_id')->groupBy('services.id')->get();

        return view('frontend.services_filter', compact('organization_services'))->render();
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
        $organization = Organization::where('organizations_id','=',$id)->select('organizations.*', 'organizations.description as organization_description')->groupBy('organizations.organization_id')->first();

        $service = Service::where('name','=',$service_id)->first();

        $serviceid = $service->service_id;

        $servicename = Service::where('name','=', $service_id)->value('name');
        $service_organization = Service::where('name','=', $service_id)->value('organization');

        $service_taxonomy = Service::where('name','=', $service_id)->value('taxonomy');
        $service_contact = Service::where('name','=', $service_id)->value('contacts');
        $service_map = DB::table('services')->where('service_id','=',$serviceid)->leftjoin('locations', 'services.locations', 'like', DB::raw("concat('%', locations.location_id, '%')"))->leftjoin('services_address', 'locations.address', 'like', DB::raw("concat('%', services_address.address_recordid, '%')"))->get();

        // $organization = DB::table('services_organizations')->where('organization_x_id', '=', $service_organization)->value('organization_name');

        $taxonomy = Taxonomy::where('taxonomy_id', '=', $service_taxonomy)->select('taxonomy_id', 'name')->first();
        $contacts = Contact::where('contact_id', '=', $service_contact)->value('name');

        
        $service_details = DB::table('services')->where('name', '=', $service_id)->leftjoin('details', 'services.details', 'like', DB::raw("concat('%', details.detail_id, '%')"))->select('details.value', 'details.detail_type')->get();

        $entity = EntityOrganization::where('types', '=', $organization->type)->first(); 
 
        return view('frontend.organization_service', compact('organization', 'taxonomys','service_name','service','organization','program','taxonomy', 'contacts', 'service_map', 'service_details','servicename', 'entity'));
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

    public function searchaddress(Request $request)
    {
        $ip= \Request::ip();

        $search_address = $request->input('search_address');

        if($search_address == ''){
            $search_address = 'aaa';
        }
        else{
            $search_address = $search_address;
        }
        
        $response = Geocode::make()->address($search_address);
    //     $response = Geocode::make()->address('1 Infinite Loop');
    //     if ($response) {
    //         echo $response->latitude();
    //         echo $response->longitude();
    //         echo $response->formattedAddress();
    //         echo $response->locationType();
    // //         echo $response->raw()->address_components[8]['types'][0];
    // // echo $response->raw()->address_components[8]['long_name'];
    //        dd($response);
    //     }

        $lat =$response->latitude();
        $lng =$response->longitude();

        // $lat =37.3422;
        // $lng = -121.905;

        $locations = Location::select(DB::raw('*, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
        ->having('distance', '<', 2)
        ->orderBy('distance')
        ->get();

        $services = [];
        foreach ($locations as $key => $location) {
            
            $values = Service::where('locations', 'like', '%'.$location->location_recordid.'%');
            foreach ($values as $key => $value) {
                $services[] = $value->id;
            }
        }


        if(isset($values)){
            $organization_services =  $values->leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->leftjoin('services_organizations', 'services.organization', '=', 'services_organizations.organization_recordid')->select('services.*', DB::raw('group_concat(services_phones.services_phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'), 'services_organizations.organization_x_id')->groupBy('services.id')->get();
        }
        else{
            $organization_services = [];
        }  

        // var_dump($organization_services);
        // exit();
        
        return view('frontend.services_filter', compact('organization_services'))->render();

    }

    public function searchnear(Request $request)
    {
        $ip= \Request::ip();
        // echo $ip;
        $data = \Geolocation::get($ip);

        // $auth = new Location();
        // $locations = $auth->geolocation(40.573414, -73.987818);
        // var_dump($locations);


        $lat =floatval($data->latitude);
        $lng =floatval($data->longitude);

        // $lat =37.3422;
        // $lng = -121.905;

        $locations = Location::select(DB::raw('*, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
        ->having('distance', '<', 2)
        ->orderBy('distance')
        ->get();


        $services = [];
        foreach ($locations as $key => $location) {
            
            $values = Service::where('locations', 'like', '%'.$location->location_recordid.'%');
            foreach ($values as $key => $value) {
                $services[] = $value->id;
            }
        }

        if(isset($values)){
            $organization_services =  $values->leftjoin('services_phones', 'services.phones', 'like', DB::raw("concat('%', services_phones.phone_recordid, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->leftjoin('services_organizations', 'services.organization', '=', 'services_organizations.organization_recordid')->select('services.*', DB::raw('group_concat(services_phones.services_phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'), 'services_organizations.organization_x_id')->groupBy('services.id')->get();
        }
        else{
            $organization_services = [];
        }     

        // var_dump($organization_services);
        // exit();
        
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
