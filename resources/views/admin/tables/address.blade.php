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
                                    <th class="text-center">Address</th>
                                    <th class="text-center">City</th>
                                    <th class="text-center">State Province</th>
                                    <th class="text-center">Postal Code</th>
                                    <th class="text-center">Attention</th>
                                    <th class="text-center">Region</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adds as $key => $address)
                                <tr id="address{{$address->id}}" class="{{$address->flag}}">
                                    <td class="text-center">{{$address->id}}</td>
                                    <td class="text-center">{{$address->address_1}}</td>
                                    <td class="text-center">{{$address->city}}</td>
                                    <td class="text-center">{{$address->state_province}}</td>
                                    <td class="text-center">{{$address->postal_code}}</td>
                                    <td class="text-center">{{$address->attention}}</td>
                                    <td class="text-center">{{$address->region}}</td>
                                    <td class="text-center">{{$address->country}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$address->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $adds->links() !!}
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
                <h4 class="modal-title">Address</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Address</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="address_1" name="address_1" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">City</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="city" name="city" value=""></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">State province</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="state_province" name="state_province" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Postal code</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Attention</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="attention" name="attention" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Region</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="region" name="region" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Country</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="country" name="country" value="">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="address_id" name="address_id" value="0">
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
<script src="{{asset('js/address_ajaxscript.js')}}"></script>


