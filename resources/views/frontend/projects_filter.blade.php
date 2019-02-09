<div class="col-sm-12" style="padding-left:0px;">
  <div class="box padding_0 table_data">
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
                            <td class="project-link" id="{{$organization_project->project_projectid}}"><a> {{$organization_project->project_projectid}}</a></td>
                            <td>AGD SHAN</td>
                            <td style="text-align: left;">{{$organization_project->project_description}}</td>
                            <td class="text-right">${{number_format($organization_project->project_totalcost)}}</td>
                          </tr>
                      @endif
                  @endforeach
              </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/frontend/organization_project_ajax.js') }}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'pageLength'  : 30,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false,
      'responsive': true
  });
});
</script>
