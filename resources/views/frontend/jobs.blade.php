@extends('layouts.app')
@section('title', 'Jobs')

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
                <div class="padding_0 endosment_table table-responsive">
                    <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                            <th style="text-align:center; width: 8%; vertical-align: middle;" class="sorting_asc">ID#</th>
                            <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Agency</th>
                            <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Business Title</th>
                            <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Job Category</th>
                            <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Work Location</th>
                            <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Posting Data</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td><a href="#">172053</a></td>
                            <td><a href="#">Health and Hospitals Corp.</a></td>
                            <td>311 Call Center Manager</td>
                            <td>Community & Business Services</td>
                            <td>Manhattan, NY</td>
                            <td>10/21/2014</td>
                        </tr>
                        <tr>
                            <td><a href="#">172053</a></td>
                            <td><a href="#">Health and Hospitals Corp.</a></td>
                            <td>311 Call Center Manager</td>
                            <td>Community & Business Services</td>
                            <td>Manhattan, NY</td>
                            <td>10/21/2014</td>
                        </tr>
                        <tr>
                            <td><a href="#">172053</a></td>
                            <td><a href="#">Health and Hospitals Corp.</a></td>
                            <td>311 Call Center Manager</td>
                            <td>Community & Business Services</td>
                            <td>Manhattan, NY</td>
                            <td>10/21/2014</td>
                        </tr>
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