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
use App\Models\Regular;

class LocationController extends Controller
{
    public function all()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $locations_all = DB::table('locations')->leftjoin('phones', 'locations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('locations.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'))->groupBy('locations.id')->leftjoin('organizations', 'locations.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('services', 'locations.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('locations.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('organizations.name as organization_name'), DB::raw('services.name as service_name'))->get();
        $location_map = DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->get();
        return view('frontend.locations', compact('servicetypes','projecttypes','organizationtypes','filter','locations_all', 'location_map'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find($id)
    {
        $location_name = Location::where('location_id','=', $id)->value('name');

        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);
        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $location = DB::table('locations')->leftjoin('phones', 'locations.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->select('locations.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'))->groupBy('locations.id')->leftjoin('organizations', 'locations.organization', 'like', DB::raw("concat('%', organizations.organization_id, '%')"))->leftjoin('services', 'locations.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('locations.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('organizations.name as organization_name'), DB::raw('organizations.organizations_id as organizations_id'), DB::raw('services.name as service_name'), DB::raw('services.service_id as service_id'))->where('locations.location_id','=', $id)->first();

        $location_map =DB::table('locations')->leftjoin('address', 'locations.address', 'like', DB::raw("concat('%', address.address_id, '%')"))->leftjoin('regulars', 'locations.regular_schedule', 'like', DB::raw("concat('%', regulars.regular_id, '%')"))->where('location_id','=', $id)->first();

        $location_services = DB::table('locations')->where('location_id','=', $id)->leftjoin('services', 'locations.services', 'like', DB::raw("concat('%', services.service_id, '%')"))->select('services.*')->leftjoin('phones', 'services.phones', 'like', DB::raw("concat('%', phones.phone_id, '%')"))->leftjoin('taxonomies', 'services.taxonomy', '=', 'taxonomies.taxonomy_id')->select('services.*', DB::raw('group_concat(phones.phone_number) as phone_numbers'), DB::raw('taxonomies.name as taxonomy_name'))->groupBy('services.id')->get();

        return view('frontend.location', compact('servicetypes','projecttypes','organizationtypes', 'filter','location','location_services', 'location_map'));
    }
}
