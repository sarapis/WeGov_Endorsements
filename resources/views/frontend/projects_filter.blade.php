<div class="box" style="margin-bottom: 0;">
  <div class="box-body no-padding">
      <table id="example3" class="table table-hover" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th>Project Description</th>
                  <th class="text-right" style="padding-right: 50px;">Cost</th>
                  <th class="text-center">ID</th>
              </tr>
          </thead>
          <tbody>
              @foreach($allprojects as $organization_project)
                  @if($organization_project->project_description!=null)
                      <tr>
                        <td>{{$organization_project->project_description}}</td>
                        <td class="text-right" style="padding-right: 50px;">${{number_format($organization_project->project_totalcost)}}</td>
                        <td class="project-link" id="{{$organization_project->project_recordid}}">{{$organization_project->project_projectid}}</td>
                      </tr>
                  @endif
              @endforeach
          </tbody>
      </table>
  </div>
</div>
<script src="{{ asset('js/frontend/organization_project_ajax.js') }}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
  });
});
