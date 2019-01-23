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
    <div class="col-sm-9"  id="project_content" style="padding-top: 10px;">
        <div id="wrapper">
        <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">

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
                              <div class="panel" style="padding-top: 20px;">
                                  <div class="panel-body">
                                      <div class="row" style="padding:0 !important;">
                                          <div class="col-lg-8">
                                              
                                              <p style="font-size: 25px;color: #357ca5;">{{$project->project_description}}</p>

                                              <p><code> Project ID</code> {{$project->project_projectid}}</p>

                                              <p><code> Organization</code><a href="/organization_{{$organization_id}}/projects" style="color: #428bca;"> {{$project->magencyacro}}</a></p>

                                              <p><code> City Cost</code> ${{number_format($project->project_citycost)}}</p>

                                              <p><code> Non-City Cost</code> ${{number_format($project->project_noncitycost)}}</p>

                                              <p><code> Total Cost</code> ${{number_format($project->project_totalcost)}}</p>


                                              <p><code> Commitments</code> {{sizeof(explode(",", $project->project_commitments))}}</p>


                                          </div>
                                          <div class="col-lg-4">
                                              <div class="portlet box">

                                                  <div id="mymap_project_type"></div>

                                              </div>
                                          </div>
                                      </div>
                                      <div class="contain-fluid">
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
                                          
                                      </div>
                                  </div>
                              </div>
                          </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--END CONTENT-->

        </div>
        <!--END PAGE WRAPPER-->
    </div>
</div>

<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script type="text/javascript">

function escapeHtml(text) {
  return text
      .replace("&amp;",'&')
      .replace("&lt;",'<')
      .replace("&gt;",'>')
      .replace("&quot;",'"')
      .replace("&#039;","'");
}


$('.project-type').prop('checked',false);
$('.project-type').each(function(){
    let inputval = $(this).next().text().toLowerCase();

    let ser_cate = "";
    if(inputval == escapeHtml(ser_cate).toLowerCase()){
        $(this).prop('checked',true);
    }
});

$('.organization-checkbox').prop('checked',false);
$('.organization-checkbox').each(function(){
    let inputval = $(this).next().text().toLowerCase();
    let ser_cate = "{{$project->magencyacro}}";
    if(inputval == escapeHtml(ser_cate).toLowerCase()){
        $(this).prop('checked',true);
    }
});

var locations = <?php print_r(json_encode($project)) ?>;

if (locations.project_lat!=0 && locations.project_long!=0){
   var mymap_project_type = new GMaps({
      el: '#mymap_project_type',
      lat: locations.project_lat,
      lng: locations.project_long,
      zoom:10
    }); 
}
else{
    var mymap_service_profile = new GMaps({
      el: '#mymap_project_type',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });
}


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
