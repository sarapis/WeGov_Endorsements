<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Organization;
use App\Models\Dataset_api;
use App\Http\Requests;
use File;

class AdminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function job()
    {

        Job::truncate();

        $path = Dataset_api::find(6)->api_path;

        $url= $path."?%24limit=5000";
        $json = file_get_contents($url);
        $data = json_decode($json);

        foreach ($data as $value) {
            $job = new Job();
            $job->job_id = isset($value->job_id)?$value->job_id:null;
            $job->agency = isset($value->agency)?$value->agency:null;
            $job->posting_type = isset($value->posting_type)?$value->posting_type:null;
            $job->of_positions = isset($value->__of_positions)?$value->__of_positions:null;
            $job->business_title = isset($value->business_title)?$value->business_title:null;
            $job->civil_service_title = isset($value->civil_service_title)?$value->civil_service_title:null;
            $job->title_code_no = isset($value->title_code_no)?$value->title_code_no:null;
            $job->level = isset($value->level)?$value->level:null;
            $job->job_category = isset($value->job_category)?$value->job_category:null;
            $job->full_time_part_time_indicator = isset($value->full_time_part_time_indicator)?$value->full_time_part_time_indicator:null;
            $job->salary_range_from = isset($value->salary_range_from)?$value->salary_range_from:null;
            $job->salary_range_to = isset($value->salary_range_to)?$value->salary_range_to:null;
            $job->salary_frequency = isset($value->salary_frequency)?$value->salary_frequency:null;
            $job->work_location = isset($value->work_location)?$value->work_location:null;
            $job->division_work_unit = isset($value->division_work_unit)?$value->division_work_unit:null;
            $job->job_description = isset($value->job_description)?$value->job_description:null;
            $job->minimum_qual_requirements = isset($value->minimum_qual_requirements)?$value->minimum_qual_requirements:null;
            $job->preferred_skills = isset($value->preferred_skills)?$value->preferred_skills:null;
            $job->additional_information = isset($value->additional_information)?$value->additional_information:null;
            $job->to_apply = isset($value->to_apply)?$value->to_apply:null;
            $job->hours_shift = isset($value->hours_shift)?$value->hours_shift:null;
            $job->work_location_1 = isset($value->work_location_1)?$value->work_location_1:null;
            $job->recruitment_contact = isset($value->recruitment_contact)?$value->recruitment_contact:null;
            $job->residency_requirement = isset($value->residency_requirement)?$value->residency_requirement:null;
            $job->posting_date = isset($value->posting_date)?$value->posting_date:null;
            $job->post_until = isset($value->post_until)?$value->post_until:null;
            $job->posting_updated = isset($value->posting_updated)?$value->posting_updated:null;
            $job->process_date = isset($value->process_date)?$value->process_date:null;

            $job->save(); 
        }
        exit();
            
        
    }

    public function index()
    {
        $jobs = Job::paginate(15);
        return view('admin.tables.job')->with('jobs', $jobs);
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
        $job = Job::where('id', '=', $id)->first();
        return response()->json($job);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::where('id', '=', $id)->first();
        return response()->json($job);
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
        $job = Job::find($id);
        $job->job_id = $request->job_id;
        $job->organization_code = $request->organization_code;       
        $job->agency = $request->agency;
        $job->posting_type = $request->posting_type;       
        $job->of_positions = $request->of_positions;
        $job->business_title = $request->business_title;
        $job->civil_service_title = $request->civil_service_title;
        $job->title_code_no = $request->title_code_no;
        $job->level = $request->level;
        $job->job_category = $request->job_category;
        $job->full_time_part_time_indicator = $request->full_time_part_time_indicator;
        $job->salary_range_from = $request->salary_range_from;
        $job->salary_range_to = $request->salary_range_to;
        $job->salary_frequency = $request->salary_frequency;
        $job->work_location = $request->work_location;
        $job->division_work_unit = $request->division_work_unit;
        $job->job_description = $request->job_description;
        $job->minimum_qual_requirements = $request->minimum_qual_requirements;
        $job->preferred_skills = $request->preferred_skills;
        $job->additional_information = $request->additional_information;
        $job->to_apply = $request->to_apply;
        $job->hours_shift = $request->hours_shift;
        $job->work_location_1 = $request->work_location_1;
        $job->residency_requirement = $request->residency_requirement;
        $job->posting_date = $request->posting_date;
        $job->post_until = $request->post_until;
        $job->posting_updated = $request->posting_updated;
        $job->process_date = $request->process_date;

        $coded = Organization::where('organizations_id', '=', $job->organization_code)->first();
        if($coded)
            $job->flag = 'coded';
        else
            $job->flag = 'modified';
        
        $job->save();

        Job::where('agency', $job->agency)->update(['organization_code'=>$job->organization_code, 'flag'=>$job->flag]);

        return response()->json($job);
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
