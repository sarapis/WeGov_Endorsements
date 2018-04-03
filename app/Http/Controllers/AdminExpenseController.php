<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Expense;

class AdminExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
