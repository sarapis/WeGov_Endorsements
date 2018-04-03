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
        Address Table
        <small>Administrator Access</small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Source URL: https://airtable.com/tblbSlsxpN2oz40gH/viwC9NVajQ9B3Dtde</h3>
                    </div>

                    <div class="box-body table-responsive">
                        
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Number</th>
                                    <th class="text-center">Serivce at location ID</th>
                                    <th class="text-center">Extension</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phones as $key => $phone)
                                <tr id="phone{{$phone->id}}" class="{{$phone->flag}}">
                                    <td class="text-center">{{$phone->id}}</td>
                                    <td class="text-center">{{$phone->phone_number}}</td>
                                    <td class="text-center">{{$phone->service_at_location_id}}</td>
                                    <td class="text-center">{{$phone->extension}}</td>
                                    <td class="text-center"><span class="badge bg-purple">{{$phone->type}}</span></td>
                                    <td class="text-center">{{str_limit($phone->description, 40)}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$phone->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $phones->links() !!}
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
                <h4 class="modal-title">Phones</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Number</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Service at location ID</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="service_at_location_id" name="service_at_location_id" value=""></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Extension</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="extension" name="extension" value="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Type</label>

                      <div class="col-sm-7">
                        <select class="form-control" id="type">
                            <option></option>
                            <option value="voice">voice</option>
                            <option value="textphone">textphone</option>
                            <option value="cell">cell</option>
                            <option value="fax">fax</option>
                            <option value="phone 1">phone 1</option>
                            <option value="Agency Primary Phone">Agency Primary Phone</option>
                            <option value="phone 2">phone 2</option>
                            <option value="fax 1">fax 1</option>
                            <option value="fax 2">fax 2</option>
                            <option value="Division Primary Phone">Division Primary Phone</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Description</label>

                      <div class="col-sm-7">
                        <textarea type="text" class="form-control" id="description" name="description" value="" rows="5"></textarea>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="phone_id" name="phone_id" value="0">
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
<script src="{{asset('js/phone_ajaxscript.js')}}"></script>


