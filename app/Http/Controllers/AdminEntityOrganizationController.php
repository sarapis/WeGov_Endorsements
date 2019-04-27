<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntityOrganization;
use App\Models\Airtable_people;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminEntityOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $organizations = EntityOrganization::all();
        return view('admin.entities.organization')->with('organizations', $organizations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = EntityOrganization::where('id', '=', $id)->first();
        return response()->json($organization);
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
        $organization = EntityOrganization::find($id);
        $organization->about = $request->about;
        $organization->projects = $request->projects;
        $organization->services = $request->services;
        $organization->money = $request->money;
        $organization->people = $request->people;
        $organization->laws = $request->laws;
        $organization->endorsements = $request->endorsements;
        $organization->candidates = $request->candidates;
        $organization->requests = $request->requests;
        $organization->requests_from = $request->requests_from;
        $organization->indicators = $request->indicators;
        $organization->jobs = $request->jobs;
        $organization->save();
        // var_dump($project);
        // exit();
        return response()->json($organization);
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
