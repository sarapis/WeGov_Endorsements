@extends('layouts.app')
@section('title', 'Projects')

@section('content')
<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-3 side-filter">
          @include('layouts.project_sidebar')
        </div>
        <div class="col-sm-9 organization_right" id="project_content" >
          <div class="col-sm-12" style="padding-left:0px;">
            <div class="box padding_0 table_data">
                <div class="padding_0 table-responsive">
                    <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Project ID</th>
                              <th>Agency</th>
                              <th style="text-align: left;">Project Description</th>
                              <th style="padding-right: 50px;">Cost</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($allprojects as $organization_project)
                              @if($organization_project->project_description!=null)
                                  <tr>
                                    <!-- <td class="project-link" id="{{$organization_project->project_projectid}}"><a> {{$organization_project->project_projectid}}</a></td> -->
                                    <td><a href="{{URL::to('organization_'.$organization_project->magency.'/projects/'.$organization_project->project_projectid)}}">{{$organization_project->project_projectid}}</a></td>
                                    <td><a href="organization_{{$organization_project->magency}}">{{$organization_project->magencyacro}}</a></td>
                                    <td style="text-align: left;">{{$organization_project->project_description}}</td>
                                    <td class="text-right">${{number_format($organization_project->project_totalcost)}}</td>
                                  </tr>
                              @endif
                          @endforeach
                      </tbody>
                    </table>
                    <div class="text-right">{{ $allprojects->links() }}</div>
                    <style type="text/css">.pagination{margin-top: 0;}</style>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/frontend/organization_project_ajax.js') }}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : false,
      'pageLength'  : 20,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    });
} );
</script>
@endsection