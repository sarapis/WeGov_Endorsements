@extends('admin.layouts.dashboard')

@section('template_title') Data Sync @endsection 

@section('template_fastload_css')

@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .btn-app {
        margin: 0;
    }
    
    .probar {
        width: 80px;
    }
    .box-title{
        display: block !important;
        margin-top: 5px !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Data Sync
        <small> {{ Lang::get('pages.dashboard-access-level',['access' => $access] ) }} </small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-md-6">
                            <h4 class="box-title">Dataset Name: {{$dataset[0]->name}}</h4>
                            <h4 class="box-title">Format: Airtable API</h4>
                            <h4 class="box-title">API Path: https://api.airtable.com/v0/{{$dataset[0]->api_base}}</h4>
                            <h4 class="box-title">API Key: {{$dataset[0]->api_key}}</h4>
                            <h4 class="box-title">Notes: {{$dataset[0]->notes}}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <h4 class="box-title">All Organizations: {{$all_agencies}}</h4>
                                <h4 class="box-title">Joined Organizations: {{$join_agencies}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary btn-sm open_modal" value="1">Edit</button>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Table Name</th>
                                    <th class="text-center">Total Records</th>
                                    <th class="text-center">Last Synced</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($budgets as $budget)
                                <tr>
                                    <td class="text-center">{{$budget->id}}</td>
                                    <td class="text-center">{{$budget->table_name}}</td>
                                    <td class="text-center">{{$budget->total_records}}</td>
                                    <td class="text-center">{{$budget->last_synced}}</td>
                                    <td class="text-center">
                                        <button class="badge bg-yellow sync_now {{$budget->table_name}}">Sync Now</button>
                                       <!--  <button class="badge bg-blue"><a href="tb_{!! strtolower($budget->table_name) !!}" style="color: white;">View Table</a></button> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-md-6">
                            <h4 class="box-title">Dataset Name: {{$dataset[1]->name}}</h4>
                            <h4 class="box-title">Format: Airtable API</h4>
                            <h4 class="box-title">API Path: https://api.airtable.com/v0/{{$dataset[1]->api_base}}</h4>
                            <h4 class="box-title">API Key: {{$dataset[1]->api_key}}</h4>
                            <h4 class="box-title">Notes: {{$dataset[1]->notes}}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <h4 class="box-title">All Organizations: {{$all_organizations}}</h4>
                                <h4 class="box-title">Joined Organizations: {{$join_organizations}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary btn-sm open_modal" value="2">Edit</button>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Table Name</th>
                                    <th class="text-center">Total Records</th>
                                    <th class="text-center">Last Synced</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td class="text-center">{{$contact->id}}</td>
                                    <td class="text-center">{{$contact->table_name}}</td>
                                    <td class="text-center">{{$contact->total_records}}</td>
                                    <td class="text-center">{{$contact->last_synced}}</td>
                                    <td class="text-center">
                                        <button class="badge bg-yellow sync_now">Sync Now</button>
                                       <!--  <button class="badge bg-blue"><a href="/tb_{!! strtolower($contact->table_name) !!}" style="color: white;">View Table</a></button> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-md-6">
                            <h4 class="box-title">Dataset Name: {{$dataset[2]->name}}</h4>
                            <h4 class="box-title">Format: Airtable API</h4>
                            <h4 class="box-title">API Path: https://api.airtable.com/v0/{{$dataset[2]->api_base}}</h4>
                            <h4 class="box-title">API Key: {{$dataset[2]->api_key}}</h4>
                            <h4 class="box-title">Notes: {{$dataset[2]->notes}}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <h4 class="box-title">All Organizations: {{$all_serviceorganizations}}</h4>
                                <h4 class="box-title">Joined Organizations: {{$join_serviceorganizations}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary btn-sm open_modal" value="3">Edit</button>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Table Name</th>
                                    <th class="text-center">Total Records</th>
                                    <th class="text-center">Last Synced</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <td class="text-center">{{$service->id}}</td>
                                    <td class="text-center">{{$service->table_name}}</td>
                                    <td class="text-center">{{$service->total_records}}</td>
                                    <td class="text-center">{{$service->last_synced}}</td>
                                    <td class="text-center">
                                        <button class="badge bg-yellow sync_now">Sync Now</button>
                                       <!--  <button class="badge bg-blue"><a href="/tb_{!! strtolower($service->table_name) !!}" style="color: white;">View Table</a></button> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-md-6">
                            <h4 class="box-title">Dataset Name: {{$dataset[3]->name}}</h4>
                            <h4 class="box-title">Format: Airtable API</h4>
                            <h4 class="box-title">API Path: https://api.airtable.com/v0/{{$dataset[3]->api_base}}</h4>
                            <h4 class="box-title">API Key: {{$dataset[3]->api_key}}</h4>
                            <h4 class="box-title">Notes: {{$dataset[3]->notes}}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <h4 class="box-title">All Organizations:  {{$all_politicians}}</h4>
                                <h4 class="box-title">Joined Organizations: {{$join_politicians}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary btn-sm open_modal" value="4">Edit</button>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Table Name</th>
                                    <th class="text-center">Total Records</th>
                                    <th class="text-center">Last Synced</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($politicians as $politician)
                                <tr>
                                    <td class="text-center">{{$politician->id}}</td>
                                    <td class="text-center">{{$politician->table_name}}</td>
                                    <td class="text-center">{{$politician->total_records}}</td>
                                    <td class="text-center">{{$politician->last_synced}}</td>
                                    <td class="text-center">
                                        <button class="badge bg-yellow sync_now">Sync Now</button>
                                        <!-- <button class="badge bg-blue"><a href="/tb_{!! strtolower($service->table_name) !!}" style="color: white;">View Table</a></button> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="col-md-6">
                            <h4 class="box-title">Dataset Name: {{$dataset[4]->name}}</h4>
                            <h4 class="box-title">Format: Socrata</h4>
                            <h4 class="box-title">Api Path: {{$dataset[4]->api_path}}</h4>
                            <h4 class="box-title">Notes: {{$dataset[4]->notes}}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <h4 class="box-title">All Organizations: {{$all_greenbooks}}</h4>
                                <h4 class="box-title">Joined Organizations: {{$join_greenbooks}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary btn-sm open_modal" value="5">Edit</button>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Table Name</th>
                                    <th class="text-center">Total Records</th>
                                    <th class="text-center">Last Synced</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Greenbook</td>
                                    <td class="text-center">{{$greenbooks}}</td>
                                    <td class="text-center">{{$greenbook_date}}</td>
                                    <td class="text-center">
                                        <button class="badge bg-yellow sync_now">Sync Now</button>
                                       <!--  <button class="badge bg-blue"><a href="/tb_greenbook" style="color: white;">View Table</a></button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- Passing BASE URL to AJAX -->
        <input id="url" type="hidden" value="{{ \Request::url() }}">

        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Edit Dataset</h4>
                    </div>
                    <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Dataset Name</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="name" name="name" value="">
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Format</label>
                                <div class="col-sm-7">
                                <select class="form-control" id="format" name="format" disabled="">
                                    <option value="airtable">Airtable</option>
                                    <option value="socrata">Scorata</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">API Path</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="api_path" name="api_path" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">API Base</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="api_base" name="api_base" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">API Key</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="api_key" name="api_key" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Notes</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="notes" name="notes" value="">
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save</button>
                            <input type="hidden" id="id" name="id" value="0">
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </section>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/datasync_ajaxscript.js')}}"></script>
<style type="text/css">
    button{
        width: 85px !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var $img = $('<img class="probar titleimage" id="title" src="images/xpProgressBar.gif" alt="Loading..." />');

        $('.sync_now').click(function(){
            $(this).hide();
            var name = $(this).parent().prev().prev().prev().html();

            $(this).after($img);
            $here = $(this);
            name = name.toLowerCase();
            $.ajax({
                type: "GET",
                url: '/sync_'+name,
                success: function(result) {
                    $img.remove();
                    $here.show();
                    $here.html('Updated');
                    $here.removeClass('bg-yellow');
                    $here.addClass('bg-purple');
                    $here.parent().prev().html('<?php echo date("Y/m/d H:i:s"); ?>');
                }
            });
        });
    });
</script>