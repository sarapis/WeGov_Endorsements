@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')

<div class="demo-container mdl-grid inner_organization">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row ">
            <div class="col-sm-2 image_main"> 
              @if($organization->logo!='')
                  <img src="{{$organization->logo}}" class="img-responsive center" >
              @endif
            </div>
            <div class="col-sm-7 col-xs-12">

                <div class="pull-left org_title">{{$organization->name}}</div>
                <div class="social_icon">
                    <ul>
                        <li>@if($organization->website)
                            <a target="_blank" href="http://{{$organization->website}}" title="Website"><i class="fas fa-globe"></i></a>
                            @else
                            <a title="Website"><i class="fas fa-globe bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Facebook)
                            <a target="_blank" href="http://{{$organization->Facebook}}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @else
                            <a title="Facebook"><i class="fab fa-facebook-f bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Twitter)
                            <a target="_blank" href="http://{{$organization->Twitter}}" title="Twitter"><i class="fab fa-twitter"></i></a>
                            @else
                            <a title="Twitter"><i class="fab fa-twitter bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->RSS)
                            <a target="_blank" href="http://{{$organization->RSS}}" title="RSS"><i class="fas fa-rss"></i></a>
                            @else
                            <a title="RSS"><i class="fas fa-rss bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->phones)
                            <a href="tel: {{$organization->phones}}" title="Phone"><i class="fas fa-phone"></i></a>
                            @else
                            <a title="Phone"><i class="fas fa-phone bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->email)
                            <a href="mailto: {{$organization->email}}" title="Email"><i class="fas fa-envelope"></i></a>
                            @else
                            <a title="Email"><i class="fas fa-envelope bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->main_address)
                            <a target="_blank" href="https://www.google.com/maps/place/{{$organization->main_address}}" title="Address"><i class="fas fa-map-marker-alt"></i></a>
                            @else
                            <a title="Address"><i class="fas fa-map-marker-alt bg-disable"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
                <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
            </div>
            <div class="col-sm-3 col-xs-12">
                
                <div class="pull-left" style="padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge type_badge bg-blue">{{$organization_type}}</span>
                    </p>
                </div>
                <div class="pull-left">
                    <p class="text-tages"> Tags: <?php 
                        $tag_names = explode(',', $organization->tags);
                    ?>
                        @foreach($tag_names as $tag_name)
                            @if($tag_name!='')
                            <span class="badge tag_badge bg-blue">{{$tag_name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="menu-bar row">
            <ul class="nav nav-tabs desktop_tab" role="tablist">
                @if($entity->about == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                @endif
                @if($entity->projects == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                @endif
                @if($entity->services == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                @endif
                @if($entity->money == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                @endif
                @if($entity->people == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                @endif
                @if($entity->laws == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">LAWS</a></li>
                @endif
                @if($entity->endorsements == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                @endif
                @if($entity->candidates == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                @endif
                @if($entity->requests == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                @endif
                @if($entity->requests_from == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                @endif
                @if($entity->indicators == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/indicators" id="indicators_tab">INDICATORS</a></li>
                @endif
                @if($entity->jobs == 'On')
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/jobs" id="jobs_tab">JOBS</a></li>
                @endif
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter"><i class="fa fa-bars filter-icon" aria-hidden="true"></i> Requests  </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    @if($entity->about == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    @endif
                    @if($entity->projects == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    @endif
                    @if($entity->services == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    @endif
                    @if($entity->money == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    @endif
                    @if($entity->people == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    @endif
                    @if($entity->laws == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">LAWS</a></li>
                    @endif
                    @if($entity->endorsements == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                    @endif
                    @if($entity->candidates == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                    @endif
                    @if($entity->requests == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                    @endif
                    @if($entity->requests_from == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                    @endif
                    @if($entity->indicators == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/indicators" id="indicators_tab">INDICATORS</a></li>
                    @endif
                    @if($entity->jobs == 'On')
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}/jobs" id="jobs_tab">JOBS</a></li>
                    @endif
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="jobs_tab">
                    <div class="election_menu row">
                        <div class="col-sm-12">
                            <div class="box padding_0">
                                <div class="box-header">
                                    <h3 class="box-title"><a>Job Details</a></h3>
                                </div>
                                <div class="box-body inner_request_detail">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Job ID: <p>{{$job->job_id}}</p></h4>
                                            <h4>Business Title: <p>{{$job->business_title}}</p></h4>
                                            <h4>Civil Service Title: <p>{{$job->civil_service_title}}</p></h4>
                                            <h4>Title Classification: <p>{{$job->title_code_no}}</p></h4>
                                            <h4>Job Category: <p>{{$job->job_category}}</p></h4>
                                            <h4>Career Level : <p>Experienced (non-manager)</p></h4>
                                            <h4>Work Location: <p>{{$job->work_location}}</p></h4>
                                            <h4>Division/Work Unit: <p>{{$job->division_work_unit}}</p></h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4># of Positions: <p> {{$job->of_positions}}</p></h4>
                                            <h4>Title Code No: <p>{{$job->title_code_no}}</p></h4>
                                            <h4>Level: <p>{{$job->level}}</p></h4>
                                            <h4>Proposed Salary Range: <p>${{$job->salary_range_from}} - ${{$job->salary_range_to}} ({{$job->salary_frequency}})</p></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box padding_0">
                                <div class="box-header">
                                    <h3 class="box-title"><a>Job Description</a></h3>
                                </div>
                                <div class="box-body inner_request_detail job_details">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>{!! $job->job_description !!}</p>
                                            <h4 style="padding-top: 20px;">Minimum Qual Requirements</h4>
                                            <p>{!! $job->minimum_qual_requirements !!}</p>
                                            <h4 style="padding-top: 20px;">Preferred Skills</h4>
                                            <ul>
                                                <li><p>A Baccalaureate degree from an accredited college, or equivalent; preferably a Master’s Degree in the fields of public administration, business management, environmental planning, or a related field.</p></li>
                                                <li><p>A minimum of 10 years of full time satisfactory professional experience in the field of environmental health and safety.</p></li>
                                                <li><p>Experience overseeing large teams of staff and vendors performing multiple different types of work at a fast pace.</p></li>
                                            </ul>
                                            <h4>To Apply</h4>
                                            <p>{{$job->to_apply}}</p>
                                            <h4 style="padding-top: 20px;">Hours/ Shift: <p>{{$job->hours_shift}}</p></h4>
                                            
                                            <h4>Residency Requirement: <p>{{$job->residency_requirement}}</p></h4>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h4>Posting Date: <p> {{$job->process_date}}</p></h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4>Post Unit: <p> {{$job->post_until}}</p></h4>
                                                </div>
                                            </div>
                                            <a class="btn btn-charter" target="_blank" href="https://a127-jobs.nyc.gov/psc/nycjobs/EMPLOYEE/HRMS/c/HRS_HRAM.HRS_APP_SCHJOB.GBL?Page=HRS_APP_JBPST&Action=U&FOCUS=Applicant&SiteId=1&JobOpeningId={{$job->job_id}}&PostingSeq=1" style="width: auto;">View the Official NYC Listing to Apply</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-12">
                                    <p style="text-align: center;">The City of New York is an Equal Opportunity Employer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="/organizations" method="POST" id="organization_form" class="hidden">
        {!! csrf_field() !!}
        <input value="" id="post_value" name="post_value">
        <input value="" id="post_type" name="post_type">
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('.tag_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('tag');
        $('#post_value').val(val);
        $('#organization_form').submit();
    });
    $('.type_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('type');
        $('#post_value').val(val);
        $('#organization_form').submit();
    })
</script>

<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : true,
      'pageLength'  : 20,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });
} );
</script>
@endsection
