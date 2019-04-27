<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Budgets;
use App\Models\Services;
use App\Models\Agency;
use App\Models\Organization;
use App\Models\ServiceOrganization;
use App\Models\Greenbook;
use App\Models\Job;
use App\Models\PoliticianOrganization;
use App\Models\Airtable_politicians;
use App\Models\Dataset_api;

class DatasyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user           = \Auth::user();
        $userRole       = $user->hasRole('user');
        $editorRole     = $user->hasRole('editor');
        $adminRole      = $user->hasRole('administrator');

        if($userRole)
        {
            $access = 'User';
        } elseif ($editorRole) {
            $access = 'Editor';
        } elseif ($adminRole) {
            $access = 'Administrator';
        }

        $budgets = Budgets::all();
        $contacts = Contacts::all();
        $services = Services::all(); 
        $politicians = Airtable_politicians::all();

        $greenbooks = Greenbook::count();
        if($greenbooks==0)
            $greenbook_date ='';
        else
            $greenbook_date = Greenbook::find(1)->created_at;

        $jobs = Job::count();
        if($jobs==0)
            $job_date ='';
        else
            $job_date = Job::find(1)->created_at;

        $all_agencies = Agency::count();
        $join_agencies = Agency::whereNotNull('magency')->count();

        $all_organizations = Organization::count();
        $join_organizations = Organization::whereNotNull('organizations_id')->count();

        $all_serviceorganizations = ServiceOrganization::count();
        $join_serviceorganizations = ServiceOrganization::whereNotNull('organization_x_id')->count();

        $all_politicians = PoliticianOrganization::count();
        $join_politicians = PoliticianOrganization::whereNotNull('organizationid')->count();

        $all_greenbooks = Greenbook::count();
        $join_greenbooks = Greenbook::whereNotNull('organization_code')->count();

        $all_jobs = Job::count();
        $join_jobs = Job::whereNotNull('organization_code')->count();

        $dataset = Dataset_api::all();


        return view('admin.pages.datasync', compact('budgets', 'contacts', 'services', 'greenbooks', 'greenbook_date', 'jobs', 'job_date', 'politicians', 'all_agencies', 'join_agencies', 'all_organizations', 'join_organizations' ,'all_serviceorganizations', 'join_serviceorganizations', 'all_politicians', 'join_politicians', 'all_greenbooks', 'join_greenbooks', 'all_jobs', 'join_jobs', 'dataset'))->withUser($user)->withAccess($access);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $greenbook = Greenbook::where('id', '=', $id)->first();
        return response()->json($greenbook);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Dataset_api::where('id', '=', $id)->first();
        return response()->json($data);
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
        $data = Dataset_api::find($id);
        $data->name = $request->name;
        $data->api_path = $request->api_path;
        $data->api_base = $request->api_base;
        $data->api_key = $request->api_key;       
        $data->notes = $request->notes;
       
        $data->save();

        return response()->json($data);
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
