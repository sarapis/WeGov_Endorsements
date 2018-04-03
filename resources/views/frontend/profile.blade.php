@include('layouts.style')
<title>Project Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        .dataTables_length, .dataTables_filter{display: none;}
    </style>

<div>

    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN TOPBAR-->
     @include('layouts.header')
    <!--END TOPBAR-->
    
        <!--BEGIN SIDEBAR MENU-->
        @include('layouts.menu')
        <!--END SIDEBAR MENU-->

        <!--BEGIN PAGE WRAPPER-->
        <div id="wrapper">
        <div id="page-wrapper">
            @include('layouts.sidebar')
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title plxxl">
                        Project Profile</div>
                </div>
                <div>
                <div class="col-sm-2 text-center">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button">Type @if($project->project_type!='')
                            : {{$project->project_type}} 
                        @else: None  @endif
                        </button>
                    </div>
                </div>
                <div class="sharethis-inline-share-buttons col-sm-3"></div>
                <div class="col-sm-3">
                    <div class="collapse navbar-collapse text-center" id="navbar-collapse" style="display: block;">                                                 
                        <a target="_blank" href="https://airtable.com/shrMbpSztHkjCXbHc" class="btn btn-primary dropdown-toggle" style="padding:7px;">Add Information</a>
                    </div>
                </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li><a href="/projects">Projects</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                </ol>
                <div class="clearfix">
                </div>
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
                    <button class="cornsilk btn-blue" style="position: absolute;top: 7px;left: auto;" id="menu-toggle">
                        <a href="" class="btn btn-secondary" style="padding: 0px;font-size: 25px;"><i class="fa  fa-search" style="color: #fff;font-size: 25px;"></i></a>
                    </button>
                   
                        <div class="page-content">
                            <div class="panel panel-blue">

                                <div class="panel-body">
                                    <div class="row" style="margin: 0;padding-bottom:30px;">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <dt>Project ID: </dt><dd>{{$project->project_projectid}}</dd>
                                                <dt>Organization: </dt><dd><a href="organization_{{$project->magency}}">{{$project->magencyacro}}</a></dd>
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

            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">
                    <a href="#">&copy; ThemesGround 2015. Designed by ThemesGround </a></div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END CONTENT-->
    </div>
    <!--END PAGE WRAPPER-->
</div>
@include('layouts.script')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 0);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("mask").style.display = "none";
}
</script>

