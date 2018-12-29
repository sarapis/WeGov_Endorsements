<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Airtable_services;
use App\Functions\Airtable;
use App\Http\Requests;

class AdminScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function airtable()
    {

        Schedule::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'app2sk6MlzyikwbzL',
        ));

        $request = $airtable->getContent( 'schedule' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $schedule = new Schedule();
                $schedule->schedule_id = $record[ 'id' ];
                $schedule->schedule_services = isset($record['fields']['services'])? implode(",", $record['fields']['services']):null;
                $schedule->schedule_locations = isset($record['fields']['locations'])? implode(",", $record['fields']['locations']):null;
                $schedule->x_phones = isset($record['fields']['x-phones'])? implode(",", $record['fields']['x-phones']):null;
                $schedule->days_of_week = isset($record['fields']['days_of_week'])?$record['fields']['days_of_week']:null;
                $schedule->opens_at = isset($record['fields']['open_at'])?$record['fields']['open_at']:null;
                $schedule->closes_at = isset($record['fields']['closes_at'])?$record['fields']['closes_at']:null;
                $schedule->holiday = isset($record['fields']['holiday'])?$record['fields']['holiday']:null;
                $schedule->start_date = isset($record['fields']['start_date'])?$record['fields']['start_date']:null;
                $schedule->end_date = isset($record['fields']['end_date'])?$record['fields']['end_date']:null;
                $schedule->closed = isset($record['fields']['closed'])?$record['fields']['closed']:null;
                $schedule->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtable_services::where('table_name', '=', 'Schedule')->first();
        $airtable->total_records = Schedule::count();
        $airtable->last_synced = $date;
        $airtable->save();
    }

    public function index()
    {
        $schedules = Schedule::paginate(15);
        return view('admin.tables.schedule')->with('schedules', $schedules);
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
        $schedule = Schedule::where('id', '=', $id)->first();
        return response()->json($schedule);
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
        $schedule = Schedule::find($id);
        $schedule->days = $request->days;
        $schedule->opens_at = $request->opens_at;
        $schedule->closes_at = $request->closes_at;
        $schedule->flag = 'modified';
        $schedule->save();

        return response()->json($schedule);
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
