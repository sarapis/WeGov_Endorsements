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
                    <div class="row">
                      <div class="col-sm-12"  id="project_content" style="padding: 0;">
                        <div class="col-sm-8">
                          <div class="box">
                            <!-- /.box-header -->
                            @if($organization_projects!=null)
                            <div class="box-body no-padding">
                                <table id="example3" class="table table-hover" cellspacing="0" width="100%" style="margin-top: 0 !important;">
                                    <thead>
                                        <tr>
                                            <th>Project Description</th>
                                            <th class="text-right" style="padding-right: 50px;">Cost ($)</th>
                                            <th class="text-center">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($organization_projects as $organization_project)
                                            @if($organization_project->project_description!=null)
                                                <tr>
                                                  <td>{{$organization_project->project_description}}</td>
                                                  <td class="text-right" style="padding-right: 50px;">${{number_format($organization_project->project_totalcost)}}</td>
                                                  <td class="project-link"><a href="/organization_{{$organization->organizations_id}}/projects/{{$organization_project->project_projectid}}">{{$organization_project->project_projectid}}</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            @else
                             <div class="alert alert-danger"><strong>No Projects!</strong>
                             </div>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box" style="border-top: 2px solid #d2d6de;">
                              <div id="mymap_project"></div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
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
} );
</script>
<script type="text/javascript">

    var locations = <?php print_r(json_encode($organization_map)) ?>;


    var mymap_project = new GMaps({
      el: '#mymap_project',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value){
        if (value.latitude && value.longitude) {

            mymap_project.addMarker({
                lat: value.latitude,
                lng: value.longitude,
                title: value.name,
                infoWindow: {
                content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
                }
            });
        }
        if (value.project_lat && value.project_long) {
            mymap_project.addMarker({
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




@endsection
