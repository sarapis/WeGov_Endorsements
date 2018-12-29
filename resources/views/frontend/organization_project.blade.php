@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-right hidden-xs">
              <p class="text-tages"> Tags: <?php 
                $tag_names = explode(',', $organization->tag_names);
                ?>
              @foreach($tag_names as $tag_name)
                @if($tag_name!='')
                  <span class="badge bg-green">
                    {{$tag_name}}</span>
                @endif
              @endforeach</p>
            </div>
            <div class="pull-right hidden-xs" style="padding-left: 20px;padding-right: 10px;">
              <p class="text-types"> Type: <span class="badge bg-blue">{{$organization->type}}</span></p>
            </div>
            <div class="pull-left">{{$organization->name}}</div>
        
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li style="width:216px;"><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li style="width:125px;"><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
            </ul>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="projects">
                    <div class="container-fluid">
                        <div id="page-wrapper">
                            <!--BEGIN TITLE & BREADCRUMB PAGE-->
                            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                                <h2 class="page-header">{{$project->project_description}}</h2>
                            </div>
                            <!--END TITLE & BREADCRUMB PAGE-->
                            <div id="tab-general">
                                <div class="mbl">
                                    <div class="col-lg-12">

                                        <div class="col-md-12">
                                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="page-content">
                                            <div class="panel panel-blue">

                                                <div class="panel-body">
                                                    <div class="row" style="margin: 0;padding-bottom:30px;">
                                                        <div class="col-md-6">
                                                            <dl class="dl-horizontal">
                                                                <dt>Project ID: </dt><dd>{{$project->project_projectid}}</dd>
                                                                <dt>Organization: </dt><dd>{{$project->magencyacro}}</dd>
                                                                <dt>Description: </dt> <dd> {{$project->project_description}}</dd>
                                                                <dt>City Cost: </dt><dd> ${{number_format($project->project_citycost)}}</dd>
                                                                <dt>Non-City Cost: </dt><dd> ${{number_format($project->project_noncitycost)}}</dd>
                                                                <dt>Total Cost: </dt> <dd> ${{number_format($project->project_totalcost)}}</dd>
                                                                <dt>#Commitments:</dt> <dd>{{sizeof(explode(",", $project->project_commitments))}}</dd>
                                                            </dl>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if ($project->project_lat==0 && $project->project_long==0)
                                                              <p style="font-size: 16px; padding-right: 40px; padding-top: 60px;">There is no map data. Please add some by clicking "Add Information" and submitting an address for the project.</p>
                                                            @else
                                                            <div id="mymap_project_type"></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr class="info">
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
                                                    <dir class="text-right">
                                                            
                                                    </dir>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!--END CONTENT-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="{{ asset('js/frontend/organization_project_ajax.js') }}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
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
