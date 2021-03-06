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
use App\Models\PoliticianOrganization;
use App\Models\Airtable_politicians;

class UserController extends Controller
{

//NEW AUTH

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

        return view('admin.pages.user-home')->withUser($user)->withAccess($access);
    }

    public function datasync()
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


        return view('admin.pages.datasync', compact('budgets', 'contacts', 'services', 'greenbooks', 'greenbook_date', 'politicians', 'all_agencies', 'join_agencies', 'all_organizations', 'join_organizations' ,'all_serviceorganizations', 'join_serviceorganizations', 'all_politicians', 'join_politicians', 'all_greenbooks', 'join_greenbooks'))->withUser($user)->withAccess($access);
    }

//OLD LTE

    /**
    * Show the User DASHBOARD Page
    *
    * @return View
    */
    public function showUserDashboard()
    {
        return view('admin.layouts.dashboard');
    }

    /**
    * Show the User PROFILE Page
    *
    * @return View
    */
    public function showUserProfile()
    {
        return view('admin.layouts.user-profile');
    }

    public function show($id)
    {
        //
    }

}
