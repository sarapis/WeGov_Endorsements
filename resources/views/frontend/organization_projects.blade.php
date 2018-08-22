<div class="row">
  <div class="col-sm-3" style="border-right:1px solid #3f3f3f; padding: 0;">
      @include('layouts.sidebar')
  </div>
  <div class="col-sm-9"style="padding: 0;">
    <div class="col-sm-8">
      <div class="box">
        <!-- /.box-header -->
        @if($organization->projects!='')
        <div class="box-body no-padding">
            <table id="example2" class="table table-hover">
                <tbody>
                    <tr>
                        <th>Project Description</th>
                        <th class="text-right" style="padding-right: 50px;">Cost ($)</th>
                        <th>ID (click)</th>
                    </tr>
                    @foreach($organization_projects as $organization_project)
                        @if($organization_project->project_description!=null)
                            <tr>
                              <td>{{$organization_project->project_description}}</td>
                              <td class="text-right" style="padding-right: 50px;">${{number_format($organization_project->project_totalcost)}}</td>
                              <td><a href="projects_{{$organization_project->project_recordid}}">{{$organization_project->project_projectid}}</a></td>
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