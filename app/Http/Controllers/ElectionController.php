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


class ElectionController extends Controller
{
    //
    public function index()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);

        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $peoples = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->select('contacts.*', 'organizations.organizations_id as organizations_id', 'organizations.name as organization_name')->orderBy('name', 'asc')->paginate(28);
        
        $organization = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->select('organizations.name as organization_name')->distinct()->get(['organization_name']);
        $organization_type='';
        $taxonomy_lists = $servicetypes;
        $organization_lists = DB::table('organizations')->get();
        return view('frontend.elections', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'peoples', 'organization', 'organization_type', 'taxonomy_lists', 'organization_lists'));
    }

    public function find()
    {
        $servicetypes = DB::table('taxonomies')->get();
        $organizationtypes = DB::table('organizations')->distinct()->get(['type']);

        $projecttypes = DB::table('projects')-> distinct()->get(['project_type']);
        $service_name = '&nbsp;';
        $organization_name = '&nbsp;';
        $project_name = '&nbsp;';
        $filter = collect([$organization_name, $service_name, $project_name]);

        $peoples = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->select('contacts.*', 'organizations.organizations_id as organizations_id', 'organizations.name as organization_name')->orderBy('name', 'asc')->paginate(28);
        
        $organization = Contact::leftjoin('organizations', 'contacts.organization', '=', 'organizations.organization_id')->select('organizations.name as organization_name')->distinct()->get(['organization_name']);
        $organization_type='';
        $taxonomy_lists = $servicetypes;
        $organization_lists = DB::table('organizations')->get();
        return view('frontend.elections_detail', compact('servicetypes','projecttypes','organizationtypes', 'filter', 'peoples', 'organization', 'organization_type', 'taxonomy_lists', 'organization_lists'));
    }
}
