<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Greenbook;
use App\Models\Organization;
use App\Http\Requests;
use File;

class AdminGreenbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function greenbook()
    {

        Greenbook::truncate();

        $url="https://data.cityofnewyork.us/resource/25gq-py4s.json?%24limit=5000";
        $json = file_get_contents($url);
        $data = json_decode($json);

        foreach ($data as $value) {
            $greenbook = new Greenbook();
            $greenbook->address = isset($value->address)?$value->address:null;
            $greenbook->agency_acronym = isset($value->agency_acronym)?$value->agency_acronym:null;
            $greenbook->agency_name = isset($value->agency_name)?$value->agency_name:null;
            $greenbook->agency_primary_phone = isset($value->agency_primary_phone)?$value->agency_primary_phone:null;
            $greenbook->agency_website = isset($value->agency_website)?$value->agency_website:null;
            $greenbook->city = isset($value->city)?$value->city:null;
            $greenbook->division_name = isset($value->division_name)?$value->division_name:null;
            $greenbook->division_primary_phone = isset($value->division_primary_phone)?$value->division_primary_phone:null;
            $greenbook->fax_1 = isset($value->fax_1)?$value->fax_1:null;
            $greenbook->fax_2 = isset($value->fax_2)?$value->fax_2:null;
            $greenbook->first_name = isset($value->first_name)?$value->first_name:null;
            $greenbook->grand_parent_division = isset($value->grand_parent_division)?$value->grand_parent_division:null;
            $greenbook->great_grand_parentdivision = isset($value->great_grand_parentdivision)?$value->great_grand_parentdivision:null;
            $greenbook->last_name = isset($value->last_name)?$value->last_name:null;
            $greenbook->m_i = isset($value->m_i)?$value->m_i:null;
            $greenbook->name_suffix = isset($value->name_suffix)?$value->name_suffix:null;
            $greenbook->office_title = isset($value->office_title)?$value->office_title:null;
            $greenbook->parent_division = isset($value->parent_division)?$value->parent_division:null;
            $greenbook->phone_1 = isset($value->phone_1)?$value->phone_1:null;
            $greenbook->phone_2 = isset($value->phone_2)?$value->phone_2:null;
            $greenbook->section = isset($value->section)?$value->section:null;
            $greenbook->state = isset($value->state)?$value->state:null;
            $greenbook->zip_code = isset($value->zip_code)?$value->zip_code:null;
            $greenbook->save(); 
        }
        exit();
            
        
    }

    public function index()
    {
        $greenbooks = Greenbook::groupBy('agency_name')->paginate(15);
        return view('admin.tables.greenbook')->with('greenbooks', $greenbooks);
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
        $greenbook = Greenbook::where('id', '=', $id)->first();
        return response()->json($greenbook);
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
        $greenbook = Greenbook::find($id);
        $greenbook->address = $request->address;
        $greenbook->agency_name = $request->agency_name;
        $greenbook->agency_acronym = $request->agency_acronym;
        $greenbook->organization_code = $request->organization_code;       
        $greenbook->agency_primary_phone = $request->agency_primary_phone;
        $greenbook->agency_website = $request->agency_website;
        $greenbook->city = $request->city;
        $greenbook->division_name = $request->division_name;
        $greenbook->division_primary_phone = $request->division_primary_phone;
        $greenbook->fax_1 = $request->fax_1;
        $greenbook->fax_2 = $request->fax_2;
        $greenbook->first_name = $request->first_name;
        $greenbook->grand_parent_division = $request->grand_parent_division;
        $greenbook->great_grand_parentdivision = $request->great_grand_parentdivision;
        $greenbook->last_name = $request->last_name;
        $greenbook->m_i = $request->m_i;
        $greenbook->name_suffix = $request->name_suffix;
        $greenbook->office_title = $request->office_title;
        $greenbook->parent_division = $request->parent_division;
        $greenbook->phone_1 = $request->phone_1;
        $greenbook->phone_2 = $request->phone_2;
        $greenbook->section = $request->section;
        $greenbook->state = $request->state;
        $greenbook->zip_code = $request->zip_code;

        $coded = Organization::where('organizations_id', '=', $greenbook->organization_code)->first();
        if($coded)
            $greenbook->flag = 'coded';
        else
            $greenbook->flag = 'modified';
        
        $greenbook->save();

        Greenbook::where('agency_name', $greenbook->agency_name)->update(['organization_code'=>$greenbook->organization_code]);

        return response()->json($greenbook);
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
