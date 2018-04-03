@extends('admin.layouts.dashboard') @section('template_title') Table @endsection @section('template_fastload_css') @endsection @section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        Organization Table
        <small>Administrator Access</small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Source URL: https://airtable.com/tbleTru4Ts1k45AsV/viwCpJvG1tq0XKQZu</h3>
                    </div>

                    <div class="box-body table-responsive">
                        
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th class="text-center">No</th>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Alternate Name</th>
                                    <th class="text-center">Name</th> 
                                    <th class="text-center">Projects</th>
                                    <th class="text-center">Commitments</th>
                                    <th class="text-center">Expenses</th>
                                    <th class="text-center">Commitments Cost</th>
                                    <th class="text-center">Commitments NonCity Cost</th>  
                                    <th class="text-center">Expenses link</th>
                                    <th class="text-center">Publish</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agencies as $key => $agency)
                                <tr id="agency{{$agency->id}}" class="{{$agency->flag}}">
                                    <td class="text-center">{{$agency->id}}</td>
                                    <td class="text-center">{{$agency->magency}}</td>
                                    <td class="text-center">{{$agency->magencyname}}</td>
                                    <td class="text-center">{{$agency->magencyacro}}</td>

                                    <td class="text-center">@if($agency->projects==null)
                                      0
                                     @else
                                      {{sizeof(explode(",", $agency->projects))}}
                                      @endif
                                    </td>
                                    <td class="text-center">@if($agency->commitments==null)
                                      0
                                     @else
                                      {{sizeof(explode(",", $agency->commitments))}}
                                      @endif
                                    </td>
                                    <td class="text-center">@if($agency->expenses==null)
                                      0
                                     @else
                                      {{sizeof(explode(",", $agency->expenses))}}
                                      @endif
                                    </td>
                                    <td class="text-center">${{number_format($agency->commitments_cost)}}</td>
                                    <td class="text-center">${{number_format($agency->commitments_noncity_cost)}}</td>
                                   <td class="text-center">${{number_format($agency->total_project_cost)}}</td>
                                    <td class="text-center">@if($agency->publish==1)
                                      <i class="icon fa fa-check"></i>
                                      @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$agency->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $agencies->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>

<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Organization</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">ID</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="magency" name="magency" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Alternate Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="magencyname" name="magencyname" value=""></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="magencyacro" name="magencyacro" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Commitments Cost</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="commitments_cost" name="commitments_cost" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Commitments NonCity Cost</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="commitments_noncity_cost" name="commitments_noncity_cost" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Total Project Cost</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="total_project_cost" name="total_project_cost" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Expenses link</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="expenses_link" name="expenses_link" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Publish</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="publish" name="publish">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="agency_id" name="agency_id" value="0">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/agency_ajaxscript.js')}}"></script>


