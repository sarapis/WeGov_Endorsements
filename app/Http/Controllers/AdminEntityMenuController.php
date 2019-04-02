<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntityMenu;
use App\Models\Airtable_people;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminEntityMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $menus = EntityMenu::all();
        return view('admin.entities.menu')->with('menus', $menus);
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

    public function inarray($a, $array)
    {
        for($i = 0; $i < count($array); $i ++)
            if($a == $array[$i])
                return 1;
        return 0;
    }

    public function store(Request $request)
    {
        $menus = $request->input('menu');
        for($i = 1; $i<=7; $i++){
            $main_menu = EntityMenu::find($i);
            $main_menu->action = $this->inarray($i, $menus);
            $main_menu->save();
        }

        return redirect('entity_main');
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
