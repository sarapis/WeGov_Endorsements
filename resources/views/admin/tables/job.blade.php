@extends('admin.layouts.dashboard') 
@section('template_title')
Table 
@endsection 
@section('template_fastload_css') 
@endsection 
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    tr.modified{
        background-color: red !important;
    }

    tr.modified > td{
        background-color: red !important;
        color: white;
    }
    tr.coded > td{
        background-color: green !important;
        color: white;
    }
    .pt-0{
        padding-top: 0 !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Job Table
        <small>Administrator Access</small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Source URL: https://data.cityofnewyork.us/resource/kpav-sd4t.json</h3>
                    </div>

                    <div class="box-body table-responsive">
                        
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Job ID</th>
                                    <th class="text-center">Organization Code</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Agency</th>
                                    <th class="text-center">Posting Type</th>
                                    <th class="text-center"># Of Positions</th>
                                    <th class="text-center">Business Title</th>
                                    <th class="text-center">Civil Service Title</th>
                                    <th class="text-center">Title Code No</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center">Job Category</th>
                                    <th class="text-center">Full-Time/Part-Time indicator</th>
                                    <th class="text-center">Salary Range From</th>
                                    <th class="text-center">Salary Range To</th>
                                    <th class="text-center">Salary Frequency</th>
                                    <th class="text-center">Work Location</th>
                                    <th class="text-center">Division/Work Unit</th>
                                    <th class="text-center">Job Description</th>
                                    <th class="text-center">Minimum Qual Requirements</th>
                                    <th class="text-center">Preferred Skills</th>
                                    <th class="text-center">Additional Information</th>
                                    <th class="text-center">To Apply</th>
                                    <th class="text-center">Hours/Shift</th>
                                    <th class="text-center">Work Location 1</th>
                                    <th class="text-center">Recruitment Contact</th>
                                    <th class="text-center">Residency Requirement</th>
                                    <th class="text-center">Posting Date</th>
                                    <th class="text-center">Post Until</th>
                                    <th class="text-center">Posting Updated</th>
                                    <th class="text-center">Process Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($jobs as $key => $job)
                                <tr id="job{{$job->id}}" class="{{$job->flag}}">
                                    <td class="text-center">
                                    @if(isset($_GET['page']))
                                        {{$key+15*($_GET['page']-1)+1}}</td>
                                    @else
                                        {{$key+1}}</td>
                                    @endif
                                    <td class="text-center">{{$job->job_id}}</td>
                                    <td class="text-center">{{$job->organization_code}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$job->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                    <td class="text-center">{{$job->agency}}</td>
                                    <td class="text-center">{{$job->posting_type}}</td>
                                    <td class="text-center">{{$job->of_positions}}</td>
                                    <td class="text-center">{{$job->business_title}}</td>
                                    <td class="text-center">{{$job->civil_service_title}}</td>
                                    <td class="text-center">{{$job->title_code_no}}</td>
                                    <td class="text-center">{{$job->level}}</td>
                                    <td class="text-center">{{$job->job_category}}</td>
                                    <td class="text-center">{{$job->full_time_part_time_indicator}}</td>
                                    <td class="text-center">{{$job->salary_range_from}}</td>
                                    <td class="text-center">{{$job->salary_range_to}}</td>
                                    <td class="text-center">{{$job->salary_frequency}}</td>
                                    <td class="text-center">{{$job->work_location}}</td>
                                    <td class="text-center">{{$job->division_work_unit}}</td>
                                    <td class="text-center">{{str_limit($job->job_description, 30)}}</td>
                                    <td class="text-center">{{str_limit($job->minimum_qual_requirements, 30)}}</td>
                                    <td class="text-center">{{str_limit($job->preferred_skills, 30)}}</td>
                                    <td class="text-center">{{str_limit($job->additional_information, 30)}}</td>
                                    <td class="text-center">{{str_limit($job->to_apply, 30)}}</td>
                                    <td class="text-center">{{$job->hours_shift}}</td>
                                    <td class="text-center">{{$job->work_location_1}}</td>
                                    <td class="text-center">{{$job->recruitment_contact}}</td>
                                    <td class="text-center">{{str_limit($job->residency_requirement, 30)}}</td>
                                    <td class="text-center">{{$job->posting_date}}</td>
                                    <td class="text-center">{{$job->post_until}}</td>
                                    <td class="text-center">{{$job->posting_updated}}</td>
                                    <td class="text-center">{{$job->process_date}}</td>

                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $jobs->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>

<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Job</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Job ID</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="job_id" name="job_id" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Organization Code</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="organization_code" name="organization_code" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Agency</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="agency" name="agency" value=""></input>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Posting Type</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="posting_type" name="posting_type" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label"># Of Positions</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="of_positions" name="of_positions" value=""></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Business Title</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="business_title" name="business_title">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Civil Service Title</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="civil_service_title" name="civil_service_title">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Title Code No</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="title_code_no" name="title_code_no">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Level</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="level" name="level">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Job Category</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="job_category" name="job_category">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Full-Time/Part-Time indicator</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="full_time_part_time_indicator" name="full_time_part_time_indicator">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Salary Range From</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="salary_range_from" name="salary_range_from">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Salary Range To</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="salary_range_to" name="salary_range_to">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Salary Frequency</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="salary_frequency" name="salary_frequency">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Work Location</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="work_location" name="work_location">
                              </div>
                            </div>                           
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Division/Work Unit</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="division_work_unit" name="division_work_unit">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Job Description</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="job_description" name="job_description">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Minimum Qual Requirements</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="minimum_qual_requirements" name="minimum_qual_requirements">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Preferred Skills</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="preferred_skills" name="preferred_skills">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Additional Information</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="additional_information" name="additional_information">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">To Apply</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="to_apply" name="to_apply">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Hours/Shift</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="hours_shift" name="hours_shift">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Work Location 1</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="work_location_1" name="work_location_1">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Recruitment Contact</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="recruitment_contact" name="recruitment_contact">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Residency Requirement</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="residency_requirement" name="residency_requirement">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Posting Date</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="posting_date" name="posting_date">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Post Until</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="post_until" name="post_until">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Posting Updated</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="posting_updated" name="posting_updated">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Process Date</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="process_date" name="process_date">
                              </div>
                            </div>
                        </div>
                    </div>    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="id" name="id" value="0">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/job_ajaxscript.js')}}"></script>


