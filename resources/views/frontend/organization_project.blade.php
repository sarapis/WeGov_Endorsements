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
                
                <div class="pull-left" style="padding-right: 20px;">
                    <p class="text-types"> Type: 
                        <span class="badge type_badge bg-blue">{{$organization->type}}</span>
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
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
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
                @if($entity->charter == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
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
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter"><i class="fa fa-bars filter-icon" aria-hidden="true"></i> Projects </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    @if($entity->about == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    @endif
                    @if($entity->projects == 'On')
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
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
                    @if($entity->charter == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
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
                </ul>
            </div>
            
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="projects">
                    <div class="election_menu">
                        <div class="col-sm-12">
                            <div class="box padding_0">
                                <div class="box-header">
                                    <h3 class="box-title"><a>{{$project->project_description}}</a></h3>
                                </div>
                                <div class="box-body inner_request_detail">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <h4>Project ID: <p>{{$project->project_projectid}}</p></h4>
                                            <h4>Organization: <p>{{$project->magencyacro}}</p></h4>
                                            <h4>Description: <p>{{$project->project_description}}</p></h4>
                                            <h4>City Cost: <p> ${{number_format($project->project_citycost)}}</p></h4>
                                            <h4>Non-City Cost: <p>${{number_format($project->project_noncitycost)}}</p></h4>
                                            <h4>Total Cost : <p> ${{number_format($project->project_totalcost)}}</p></h4>
                                            <h4>#Commitments: <p>{{sizeof(explode(",", $project->project_commitments))}}</p></h4>
                                        </div>
                                        <div class="col-sm-5">
                                            @if ($project->project_lat==0 && $project->project_long==0)
                                              <p style="font-size: 16px; padding-right: 40px; padding-top: 60px;">There is no map data. Please add some by clicking "Add Information" and submitting an address for the project.</p>
                                            @else
                                            <div id="mymap_project_type"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box padding_0">
                                <div class=" inner_request_detail">
                                    <div class="">
                                        <div class="padding_0 table-responsive">
                                            <table id="example" class="table table-bordered" cellspacing="0" width="100%" style="margin-bottom: 0px !important;border: none;">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Commitment Date</th>
                                                        <th>Non-City Cost</th>
                                                        <th>City Cost</th>
                                                        <th>Budgetline</th>
                                                        <th>FMS Number</th>
                                                        <th>Commitment Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tblData">
                                                    @foreach ($commitments as $commitment)
                                                    <tr>
                                                        <td>{{$commitment->description}}</td>
                                                        <td>{{$commitment->plancommdate}}</td>
                                                        <td>${{number_format($commitment->noncitycost)}}</td>
                                                        <td>${{number_format($commitment->citycost)}}</td>
                                                        <td>{{$commitment->budgetline}}</td>
                                                        <td>{{$commitment->fmsnumber}}</td>
                                                        <td>{{$commitment->commitmentcode}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
<script src="{{ asset('js/frontend/organization_project_ajax.js') }}"></script>
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
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    });
} );<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">

    var locations = <?php print_r(json_encode($project)) ?>;

    var mymap_project_type = new GMaps({
      el: '#mymap_project_type',
      lat: locations.project_lat,
      lng: locations.project_long,
      zoom:10
    });

        if (locations.project_lat!=0 && locations.project_long!=0) {

            mymap_project_type.addMarker({
                lat: locations.project_lat,
                lng: locations.project_long,
                title: locations.project_projectid,
                infoWindow: {
                maxWidth: 150,
                content: ('<a>'+locations.project_projectid+'</a>')
                }
            });
        }

</script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'pageLength'  : 25,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
  });
});
</script>
@endsection
