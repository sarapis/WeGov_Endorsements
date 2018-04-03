<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Http\Requests;

class AdminAgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::paginate(15);
        return view('admin.tables.agency')->with('agencies', $agencies);
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
        $agency = Agency::where('id', '=', $id)->first();
        return response()->json($agency);
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
        $agency = Agency::find($id);
        // $project = Project::where('id', '=', $id)->first();
        $agency->magency = $request->magency;
        $agency->magencyname = $request->magencyname;
        $agency->magencyacro = $request->magencyacro;
        $agency->commitments_cost = $request->commitments_cost;
        $agency->commitments_noncity_cost = $request->commitments_noncity_cost;
        $agency->total_project_cost = $request->total_project_cost;
        $agency->expenses_link = $request->expenses_link;
        $agency->publish = $request->publish;
        $agency->flag = 'modified';
        $agency->save();
        // var_dump($project);
        // exit();
        return response()->json($agency);
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
