@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-right hidden-xs" style="padding-left: 20px;">
              <p class="text-title-tages">Public Safely</p>
            </div>
            <div class="pull-right hidden-xs">
              <p class="text-title-tages">NYPD</p>
            </div>
            <div class="pull-left">{{$organization->name}}</div>
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab" class="menu-title">ABOUT</a></li>
                <li role="presentation"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">PROJECTS</a></li>
                <li role="presentation"><a href="#services" aria-controls="messages" role="tab" data-toggle="tab">SERVICES</a></li>
                <li role="presentation"><a href="#money" aria-controls="money" role="tab" data-toggle="tab">MONEY</a></li>
                <li role="presentation"><a href="#people" aria-controls="people" role="tab" data-toggle="tab">PEOPLE</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;">
                                <div class="row">
                                    <div class="col-md-7" style="padding-top: 5px;">
                                    <p>{!! $organization->organization_description !!}</p>
                                    </div>
                                    <div class="col-md-5">
                                        @if($organization->logo!='')
                                            <img src="{{$organization->logo}}" class="img-responsive">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Operating Acitivities</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 40px;">
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-operating">NYC Services</h5>
                                                    <h3 class="box-body-operating"><b>@if($original_organization->services!='')
                                                        {{sizeof(explode(",", $original_organization->services))}}
                                                        @else 0 @endif</b></h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-operating">Capital Projects</h5>
                                                    <h3 class="box-body-operating"><b>@if($organization->projects!=null)
                                                        {{sizeof(explode(",", $organization->projects))}}
                                                        @else 0 @endif</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Total Budgets</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 40px;">
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-budget">Expense Budget</h5>
                                                    <h3 class="box-body-budget"><b>${{$organization->total_project_cost}}</b></h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-budget">Capital Budgets</h5>
                                                    <h3 class="box-body-budget"><b>${{$organization->expenses_budgets}}</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box" style="border-top: 2px solid #d2d6de;">
                                <div id="mymap" style="width: 100%; height: 417px;"></div>
                                <div class="box-footer text-center" style="height: 115px;">
                                    <a class="btn btn-app btn-link" href="tel:{{$organization->phone_number}}">
                                        <i class="fa md md-phone"></i> Call
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-place"></i> Location
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-link"></i> Edit
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-publish"></i> Share
                                        <div class="ripple-container"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Twitter feed</p>
                                <button class="btn btn-tweet">Tweet at NYPD</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Facebook feed</p>
                                <button class="btn btn-facebook">Follow NYPD</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">RSS Feed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="projects">

                <p>Projects implemented by the <b>{{$organization->name}}</b></p>
                <div class="box">
                    <!-- /.box-header -->
                    @if($organization->projects!='')
                    <div class="box-body no-padding">
                        <table id="example2" class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Project Description</th>
                                    <th class="text-center">Commitments (#)</th>
                                    <th class="text-right" style="padding-right: 50px;">Cost ($)</th>
                                    <th>Budgetline (click)</th>
                                    <th>ID (click)</th>
                                </tr>
                                @foreach($organization_projects as $organization_project)
                                <tr>
                                  <td>{{$organization_project->project_description}}</td>
                                  <td class="text-center">
                                    {{sizeof(explode(",", $organization_project->project_commitments))}}
                                  </td>
                                  <td class="text-right" style="padding-right: 50px;">${{number_format($organization_project->project_totalcost)}}</td>
                                  <td></td>
                                  <td><a href="projects_{{$organization_project->project_recordid}}">{{$organization_project->project_projectid}}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    @else
                     <div class="alert alert-danger"><strong>No Projects!</strong></div>
                    @endif
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="money">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                <div role="tabpanel" class="tab-pane" id="services">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
                <div role="tabpanel" class="tab-pane" id="people">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
            </div>
        </div>
         @include('partials.footer')
    </div>

</div>
@include('layouts.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<script type="text/javascript">

    var locations = <?php print_r(json_encode($organization_map)) ?>;


    var mymap = new GMaps({
      el: '#mymap',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value){
        if (value.latitude && value.longitude) {

            mymap.addMarker({
                lat: value.latitude,
                lng: value.longitude,
                title: value.name,
                infoWindow: {
                content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
                }
            });
        }
        if (value.project_lat && value.project_long) {
            mymap.addMarker({
                lat: value.project_lat,
                lng: value.project_long,
                title: value.project_projectid,
                infoWindow: {
                    content: ('<a style="color:red;" href="projects_'+value.project_recordid+'">'+value.project_projectid+'</a></br>')
                }
            });
        }
    });


</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection
