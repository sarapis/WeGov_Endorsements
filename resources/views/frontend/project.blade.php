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
                                        <div style="width: 100%; height: 300px;">

                                          {!! Mapper::render() !!}
                                        </div>
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

<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

