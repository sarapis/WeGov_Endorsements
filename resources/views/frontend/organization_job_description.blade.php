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
                <li  class="active"><a href="/organization_{{$organization->organizations_id}}/jobs" id="jobs_tab">JOBS</a></li>
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
                    <li  class="active"><a href="/organization_{{$organization->organizations_id}}/jobs" id="jobs_tab">JOBS</a></li>
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
                                            <h4>Job ID: <p> 390413</p></h4>
                                            <h4>Business Title: <p>Environmental Health and Safety Officer</p></h4>
                                            <h4>Civil Service Title: <p>ASSISTANT EXECUTIVE DIRECTOR</p></h4>
                                            <h4>Title Classification: <p>Non-Competitive</p></h4>
                                            <h4>Job Category: <p>Health, Policy, Research & Analysis, Public Safety, Inspections, & Enforcement</p></h4>
                                            <h4>Career Level : <p>Executive</p></h4>
                                            <h4>Work Location: <p>Office Of The Chair</p></h4>
                                            <h4>Division/Work Unit: <p>Office of the Chair</p></h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4># of Positions: <p> 1</p></h4>
                                            <h4>Title Code No: <p>10174</p></h4>
                                            <h4>Level: <p>M5</p></h4>
                                            <h4>Proposed Salary Range: <p>$145,000.00 - $180,000.00 (Annual)</p></h4>
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
                                            <p>The New York City Housing Authority (NYCHA) is the nation’s largest public housing authority, with an operating budget of $3.3 billion and approximately 10,600 employees who manage and maintain 325 developments that house over 400,000 residents.  NYCHA also operates the country’s largest Section 8 program, which provides rental assistance to over 200,000 additional families. </p>
                                            <p>Reporting directly to the Chair of the Housing Authority, the Environmental Health and Safety Officer (“EHSO”) will be responsible for the oversight and strategic planning of the development, implementation, and continuous improvement of environmental health and safety (EHS) programs. </p>
                                            <p>The EHSO’s responsibilities include: </p>
                                            <ul>
                                                <li><p>Auditing lead paint interim controls and ensure proper abatement.</p></li>
                                                <li><p>Collaborate with the Chief Compliance Officer and Quality Assurance Officer to ensure any issues that impact the environmental health and safety of residents are addressed.</p></li>
                                                <li><p>Communicate with the public and stakeholders regarding EH&S, including creating a platform for employee and resident complaints.</p></li>
                                                <li><p>Report to the Chair and the Board on the status of the EH&S program with a specific focus on lead paint hazards, mold, pests, air quality, heat and elevators Develop and implement an EHS strategic plan including roadmap and overall goals for the EHS business units.</p></li>
                                                <li><p>Serve as NYCHA’s EHS representative with local, state, and federal officials; on committees, legal proceedings, and press.</p></li>
                                            </ul>
                                            <p>Key Competencies</p>
                                            <ul>
                                                <li><p>Imbue the Authority with strong ethical principles.</p></li>
                                                <li><p>Ability to communicate expertly and clearly, both written and verbal, to a wide range of stakeholders.</p></li>
                                                <li><p>Establish a strong network of relationships among peer leaders across other City, State and Federal agencies and government and external stakeholders.</p></li>
                                                <li><p>Develop innovative and impactful solutions that help address operation needs.</p></li>
                                                <li><p>Familiarity with environmental health and safety law and regulation.</p></li>
                                                <li><p>Demonstrated ability to make timely and sound decisions; establish priorities and successfully carry out multiple assignments, meeting critical deadlines and timeframes.</p></li>
                                            </ul>
                                            <p>Please read this posting carefully to make certain you meet the qualification requirements before applying to this position.</p>
                                            <h4>Minimum Qual Requirements</h4>
                                            <ol type="1">
                                                <li><p>A baccalaureate degree from an accredited college and three years of full-time paid experience in an administrative, executive or consultative capacity in a large public housing agency; or</p></li>
                                                <li><p>Education and/or experience which is equivalent to "1" above.</p></li>
                                            </ol>
                                            <h4>Preferred Skills</h4>
                                            <ul>
                                                <li><p>A Baccalaureate degree from an accredited college, or equivalent; preferably a Master’s Degree in the fields of public administration, business management, environmental planning, or a related field.</p></li>
                                                <li><p>A minimum of 10 years of full time satisfactory professional experience in the field of environmental health and safety.</p></li>
                                                <li><p>Experience overseeing large teams of staff and vendors performing multiple different types of work at a fast pace.</p></li>
                                            </ul>
                                            <h4>To Apply</h4>
                                            <p>Click the "Apply Now" button.</p>
                                            <h4>Hours/ Shift: <p>35 Hours.</p></h4>
                                            
                                            <h4>Work Location: <p>30-30 Thomson Avenue.LIC, NY</p></h4>
                                            <h4>Recidency Requirement: <p>NYCHA has no residency requirements.</p></h4>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h4>Posting Date: <p> 12/04/2019</p></h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4>Post Unit: <p> 04/22/2019</p></h4>
                                                </div>
                                            </div>
                                            <a class="btn btn-charter" target="_blank" href="#">Apply Now</a>
                                            <a class="btn btn-charter" target="_blank" href="#">Email to Friend</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-12">
                                    <a href="#" style="font-size: 17px;">< Return to Previous Page</a>
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
