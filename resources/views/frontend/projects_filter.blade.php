<div class="col-sm-8">
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
<script src="{{ asset('js/frontend/organization_project_ajax.js') }}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'pageLength'  : 25,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false,
      'responsive': true
  });
});
</script>
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
