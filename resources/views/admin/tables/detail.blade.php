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
                                    <th class="text-center">Value</th>
                                    <th class="text-center">Detail type</th>
                                    <th class="text-center">Services</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $key => $detail)
                                <tr id="detail{{$detail->id}}" class="{{$detail->flag}}">
                                    <td class="text-center">{{$detail->id}}</td>
                                    <td class="text-center">{{str_limit($detail->value, 40)}}</td>
                                    <td class="text-center"><span class="badge bg-purple">{{$detail->detail_type}}</span></td>
                                    <td class="text-center">
                                        @if($detail->services==null)
                                            0
                                        @else
                                        {{sizeof(explode(",", $detail->services))}}
                                        @endif
                                    </td>
                                    
                                    
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$detail->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $details->links() !!}
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
                <h4 class="modal-title">Detail</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Value</label>

                      <div class="col-sm-7">
                        <textarea type="text" class="form-control" id="value" name="value" value="" row="5"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Detail type</label>

                      <div class="col-sm-7">
                        <select class="form-control" id="detail_type">
                            <option></option>
                            <option value="language">language</option>
                            <option value="payment_accepted">payment_accepted</option>
                            <option value="required_document">required_document</option>
                            <option value="eligibility">eligibility</option>
                            <option value="funding_source">funding_source</option>
                            <option value="page_type">page_type</option>
                            <option value="uid">uid</option>
                            <option value="program_code">program_code</option>
                            <option value="blurb">blurb</option>
                            <option value="reu">reu</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="detail_id" name="detail_id" value="0">
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
<script src="{{asset('js/detail_ajaxscript.js')}}"></script>


