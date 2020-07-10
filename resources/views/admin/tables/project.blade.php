@extends('admin.layouts.dashboard') @section('template_title') Table @endsection @section('template_fastload_css') @endsection @section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="_token" content="{!! csrf_token() !!}" />
<style>
    tr.modified{
        background-color: red !important;
    }

    tr.modified > td{
        background-color: red !important;
        color: white;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Project Table
        <small>Administrator Access</small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Source URL: https://airtable.com/tblnB1gcDJx9MxUNM/viwOG7rsWapGKH8ZG</h3>
                    </div>

                    <div class="box-body table-responsive">
                        
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th class="text-center">No</th>
                                    <th class="text-center">projectid</th>
                                    <th class="text-center">managingagency</th>
                                    <th class="text-center">description</th>
                                    <th class="text-center">citycost</th>
                                    <th class="text-center">noncitycost</th>
                                    <th class="text-center">totalcost</th>
                                    <th class="text-center">commitments</th>
                                    <th class="text-center">project type</th>
                                    <th class="text-center">Latitude</th>
                                    <th class="text-center">Longitude</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody  id="products-list" name="products-list">
                                @foreach($projects as $key => $project)
                                <tr id="project{{$project->id}}" class="{{$project->flag}}">
                                    <td class="text-center">{{$project->id}}</td>
                                    <td class="text-center">{{$project->project_projectid}}</td>
                                    <td class="text-center">
                                    <span class="badge bg-yellow">{{$project->agency->magency}}</span>
                                    </td>
                                    <td class="text-center">{{$project->project_description}}</td>
                                    <td class="text-center">${{number_format($project->project_citycost)}}</td>
                                    <td class="text-center">${{number_format($project->project_noncitycost)}}</td>
                                    <td class="text-center">${{number_format($project->project_totalcost)}}</td>
                                    <!-- <td class="text-center">{{sizeof(explode(",", $project->project_commitments))}}</td> -->
                                    <td class="text-center">@foreach($project->commitments as $commitment) 
                                        <span class="badge bg-green">{{$commitment->budgetline}}</span>
                                    @endforeach
                                    </td>
                                    <td class="text-center">{{$project->project_type}}</td>
                                    <td class="text-center">
                                        @if($project->project_lat!=0)
                                            {{$project->project_lat}}                               
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($project->project_long!=0)
                                            {{$project->project_long}}                               
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$project->project_projectid}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $projects->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Project</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Project ID</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_projectid" name="project_projectid" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Description</label>

                      <div class="col-sm-7">
                        <textarea type="text" class="form-control" id="project_description" name="project_description" value=""></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Citycost</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_citycost" name="project_citycost" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Non Citycost</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_noncitycost" name="project_noncitycost" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Total Citycost</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_totalcost" name="project_totalcost" value="">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Project Type</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="project_type">
                                <option></option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Participatory Budgeting">Participatory Budgeting</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Latitude</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_lat" name="project_lat" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-3 control-label">Longitude</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="project_long" name="project_long" value="">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="project_id" name="project_id" value="0">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/project_ajaxscript.js')}}"></script>
<!-- <script type="text/javascript">
        $(function () {
            $('#user_table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script> -->

