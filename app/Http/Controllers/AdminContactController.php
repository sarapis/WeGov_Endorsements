<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Airtable_people;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Contact::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appd1eQuF0gFcOMsV',
        ));

        $request = $airtable->getContent( 'contacts' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $contact = new Contact();
                $contact->contact_id = $record[ 'id' ];
                $contact->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $contact->name_suffix = isset($record['fields']['Name Suffix'])?$record['fields']['Name Suffix']:null;
                $contact->organization = isset($record['fields']['Organization'])? implode(",", $record['fields']['Organization']):null;
                $contact->office_title = isset($record['fields']['Office Title'])?$record['fields']['Office Title']:null;
                $contact->division_name = isset($record['fields']['Division Name'])?$record['fields']['Division Name']:null;
                $contact->parent_division = isset($record['fields']['Parent Division'])?$record['fields']['Parent Division']:null;
                $contact->grand_parent_division = isset($record['fields']['Grand Parent Division'])?$record['fields']['Grand Parent Division']:null;
                $contact->great_grand_parent_division = isset($record['fields']['Great Grand Parent Division'])?$record['fields']['Great Grand Parent Division']:null;
                $contact->full_address = isset($record['fields']['full address'])?$record['fields']['full address']:null;
                $contact->address = isset($record['fields']['Address'])? implode(",", $record['fields']['Address']):null;
                $contact->email = isset($record['fields']['Email'])?$record['fields']['Email']:null;
                $contact->phone = isset($record['fields']['Phone'])? implode(",", $record['fields']['Phone']):null;
                $contact->section = isset($record['fields']['Section'])?$record['fields']['Section']:null;
                $contact->services = isset($record['fields']['Services'])?$record['fields']['Services']:null;
                $contact->sources = isset($record['fields']['Sources'])?$record['fields']['Sources']:null;
                $contact ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_people::where('table_name', '=', 'Contacts')->first();
        $airtable->total_records = Contact::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $contacts = Contact::paginate(15);
        return view('admin.tables.contact')->with('contacts', $contacts);
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
        $contact = Contact::where('id', '=', $id)->first();
        return response()->json($contact);
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
        $contact = Contact::find($id);
        $contact->name = $request->name;
        $contact->name_suffix = $request->name_suffix;
        $contact->office_title = $request->office_title;
        $contact->division_name = $request->division_name;
        $contact->parent_division = $request->parent_division;
        $contact->grand_parent_division = $request->grand_parent_division;
        $contact->great_grand_parent_division = $request->great_grand_parent_division;
        $contact->full_address = $request->full_address;
        $contact->email = $request->email;
        $contact->section = $request->section;
        $contact->flag = 'modified';
        $contact->save();

        return response()->json($contact);
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
