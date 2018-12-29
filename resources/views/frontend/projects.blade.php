@extends('layouts.app')
@section('title', 'Projects')

@section('content')
<div class="demo-container mdl-grid">
  <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col" style="padding-top: 0;">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
  <div class="col-sm-3 side-filter" style="border-right: 1px solid #3f3f3f; height: 100%;">
      <div class="row">
          @include('layouts.project_sidebar')
      </div>
  </div>
  <div class="col-sm-9" id="project_content" style="padding-top: 10px;">
    <div class="col-sm-8">
      <div class="box" style="margin-bottom: 0;">
        <!-- /.box-header -->

        <div class="box-body no-padding">
            <table id="example3" class="table table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('project_description', 'Project Description')</th>
                        <th class="text-right" style="padding-right: 50px;">@sortablelink('project_totalcost', 'Cost ($)')</th>
                        <th class="text-center">@sortablelink('project_projectid', 'ID')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allprojects as $organization_project)
                        @if($organization_project->project_description!=null)
                            <tr>
                              <td>{{$organization_project->project_description}}</td>
                              <td class="text-right" style="padding-right: 50px;">${{number_format($organization_project->project_totalcost)}}</td>
                              <td class="project-link" id="{{$organization_project->project_projectid}}">{{$organization_project->project_projectid}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="box" style="border-top: 2px solid #d2d6de;">
            <div id="mymap_service"></div>
        </div>
    </div>

  </div>
</div>
<script src="{{ asset('js/frontend/organization_project_ajax.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script type="text/javascript">

    var locations = <?php print_r(json_encode($projects)) ?>;


    var mymap_service = new GMaps({
      el: '#mymap_service',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value){

        if (value.project_lat && value.project_long) {
            mymap_service.addMarker({
                lat: value.project_lat,
                lng: value.project_long,
                title: value.project_projectid,
                infoWindow: {
                    content: ('<a>'+value.project_projectid+'</a></br>')
                }
            });
        }
    });


</script>
@endsection