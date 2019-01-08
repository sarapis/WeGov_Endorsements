<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Money;
use App\Models\Airtable_politicians;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function airtable()
    {

        Money::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appkzwotOzqU65CKW',
        ));

        $request = $airtable->getContent( 'List of Money You Owe' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $money = new Money();
                $money->recordid = $record[ 'id' ];
                $money->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $money->politician = isset($record['fields']['Politician'])? implode(",", $record['fields']['Politician']):null; 
                $money->reporting_year = isset($record['fields']['Reporting Year'])?$record['fields']['Reporting Year']:null;
                $money->name_of_creditor = isset($record['fields']['Name of Creditor'])?$record['fields']['Name of Creditor']:null;
                $money->type_of_loan = isset($record['fields']['Type of Loan'])?$record['fields']['Type of Loan']:null;
                $money->other_liability = isset($record['fields']['Other Liability'])?$record['fields']['Other Liability']:null;
                $money->nature_of_collateral = isset($record['fields']['Nature of Collateral'])?$record['fields']['Nature of Collateral']:null;
                $money->name_of_guarantor = isset($record['fields']['Name of Guarantor'])?$record['fields']['Name of Guarantor']:null;
                $money->amount_owed = isset($record['fields']['Amount Owed'])?$record['fields']['Amount Owed']:null;
                $money->comments = isset($record['fields']['Comments'])?$record['fields']['Comments']:null;
                $money ->save();
            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_politicians::where('table_name', '=', 'List_of_money_you_owe')->first();
        $airtable->total_records = Money::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $organizations = PoliticianOrganization::with('phone')->paginate(15);
        return view('admin.tables.organization')->with('organizations', $organizations);
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
        $organization = PoliticianOrganization::where('id', '=', $id)->first();
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
        $organization = PoliticianOrganization::find($id);
        $organization->organizations_id = $request->organizations_id;
        $organization->alternate_name = $request->alternate_name;
        $organization->name = $request->name;
        $organization->type = $request->type;
        $organization->website = $request->website;
        $organization->description = $request->description;
        $organization->logo = $request->logo;
        $organization->checkbook = $request->checkbook;
        $organization->internalnotes = $request->internalnotes;
        $organization->contacts_link = $request->contacts_link;
        $organization->dedupe = $request->dedupe;
        $organization->flag = 'modified';
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
