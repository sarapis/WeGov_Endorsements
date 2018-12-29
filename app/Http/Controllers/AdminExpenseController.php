<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Expense;
use App\Models\Airtable_money;
use App\Functions\Airtable;

class AdminExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Expense::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appytlCBlVIzYxE1o',
        ));

        $request = $airtable->getContent( 'expenses' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $expense = new Expense();
                $expense->expenses_id = $record[ 'id' ];
                $expense->report_sort = isset($record['fields']['Report_Sort'])?$record['fields']['Report_Sort']:null;
                $expense->agency_number = isset($record['fields']['Agency Number'])? implode(",", $record['fields']['Agency Number']):null;
                $expense->publication_date = isset($record['fields']['Publication Date'])?$record['fields']['Publication Date']:null; 
                $expense->agency_name = isset($record['fields']['Agency Name'])?$record['fields']['Agency Name']:null;
                $expense->line_number = isset($record['fields']['Line Number'])?$record['fields']['Line Number']:null;
                $expense->line_number_description = isset($record['fields']['Line Number Description'])?$record['fields']['Line Number Description']:null;
                $expense->fiscal_year1 = isset($record['fields']['Fiscal Year 1'])?$record['fields']['Fiscal Year 1']:null;
                $expense->year1_forecast = isset($record['fields']['Year 1 Forecast'])?$record['fields']['Year 1 Forecast']:null;
                $expense->year2_estimate = isset($record['fields']['Year 2 Estimate'])?$record['fields']['Year 2 Estimate']:null;
                $expense->year3_estimate = isset($record['fields']['Year 3 Estimate'])?$record['fields']['Year 3 Estimate']:null;
                $expense->year4_estimate = isset($record['fields']['Year 4 Estimate'])?$record['fields']['Year 4 Estimate']:null;
                $expense ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_money::where('table_name', '=', 'Expenses')->first();
        $airtable->total_records = Expense::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }
    public function index()
    {
        $expenses = Expense::paginate(15);
        return view('admin.tables.expense')->with('expenses', $expenses);
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
        $expense = Expense::where('id', '=', $id)->first();
        return response()->json($expense);
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
        $expense = Expense::find($id);
        // $project = Project::where('id', '=', $id)->first();
        $expense->report_sort = $request->report_sort;
        $expense->publication_date = $request->publication_date;
        $expense->agency_name = $request->agency_name;
        $expense->line_number = $request->line_number;
        $expense->line_number_description = $request->line_number_description;
        $expense->fiscal_year1 = $request->fiscal_year1;
        $expense->year1_forecast = $request->year1_forecast;
        $expense->year2_estimate = $request->year2_estimate;
        $expense->year3_estimate = $request->year3_estimate;
        $expense->year4_estimate = $request->year4_estimate;
        $expense->flag = 'modified';
        $expense->save();
        // var_dump($project);
        // exit();
        return response()->json($expense);
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
