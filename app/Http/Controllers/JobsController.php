<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Job;
use App\Models\Taxonomy;
use App\Models\Service;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Agency;
use App\Models\EntityOrganization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
//use Cornford\Googlmapper\Mapper;

class jobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //     protected $pro;

    // public function __construct(Pro $pro)
    // {
    //     $this->pro = $pro;
    // }

    public function index()
    {
        $organization_codes = Job::groupBy('organization_code')->pluck('organization_code');
        $organization_codes = json_decode(json_encode($organization_codes));

        $organizations = Agency::whereIn('magency', $organization_codes)->orderBy('magencyacro', 'asc')->get();

        $jobs = Job::orderBy('agency', 'asc')->paginate(20);

        return view('frontend.jobs', compact('organizations', 'jobs'));
    }

    public function filter(Request $request)
    {
        $ids = $request->organization_value;
         
        $check = 0;


        if(isset($ids[0])){
            $jobs = Job::whereIn('organization_code',$ids);
            $check = 1;
        }


        if($check == 1)
            $jobs = $jobs->orderBy('agency', 'asc')->get();
        else
            $jobs =  Job::orderBy('agency', 'asc')->get();


        return view('frontend.jobs_filter', compact('jobs'))->render();
    }


    public function search(Request $request)
    {
        $find = $request->search_job;

        $jobs = Job::where('business_title', 'like', '%'.$find.'%')
            ->orwhere('job_category', 'like', '%'.$find.'%')->orwhere('job_description', 'like', '%'.$find.'%')->get();

        return view('frontend.jobs_filter', compact('jobs'))->render();
    }

    
}
