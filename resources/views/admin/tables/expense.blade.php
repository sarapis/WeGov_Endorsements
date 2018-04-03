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
        Expenses Table
        <small>Administrator Access</small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Source URL: hhttps://airtable.com/tblXBMu0xyGWUpwTa/viwRuhmiEaYyFNqxX</h3>
                    </div>

                    <div class="box-body table-responsive">
                        
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Report Sort</th>
                                    <th class="text-center">Agency Number</th>
                                    <th class="text-center">Publication Date</th>
                                    <th class="text-center">Agency Name</th>
                                    <th class="text-center">Line Number</th>
                                    <th class="text-center">Line Number Description</th>
                                    <th class="text-center">Fiscal Year1</th>
                                    <th class="text-center">Year1 Forecast</th>
                                    <th class="text-center">Year2 Estimate</th>
                                    <th class="text-center">Year3 Estimate</th>
                                    <th class="text-center">Year4 Estimate</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $key => $expense)
                                <tr id="expense{{$expense->id}}" class="{{$expense->flag}}">
                                    <td class="text-center">{{$expense->id}}</td>
                                    <td class="text-center">{{$expense->report_sort}}</td>
                                    <td class="text-center"><span class="badge bg-yellow">{{$expense->agency->magency}}</span></td>
                                    <td class="text-center">{{$expense->publication_date}}</td>
                                    <td class="text-center">{{$expense->agency_name}}</span></td>
                                    <td class="text-center">{{$expense->line_number}}</td>
                                    <td class="text-center">{{$expense->line_number_description}}</td>
                                    <td class="text-center">{{$expense->fiscal_year1}}</td>
                                    <td class="text-center">${{number_format($expense->year1_forecast)}}</td>
                                    <td class="text-center">${{number_format($expense->year2_estimate)}}</td>
                                   <td class="text-center">${{number_format($expense->year3_estimate)}}</td>
                                    <td class="text-center">${{number_format($expense->year4_estimate)}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$expense->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $expenses->links() !!}
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
                <h4 class="modal-title">Commitment</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Report Sort</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="report_sort" name="report_sort" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Publication Date</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="publication_date" name="publication_date" value=""></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Agency Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="agency_name" name="agency_name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Line Number</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="line_number" name="line_number" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 0;">Line Number Description</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="line_number_description" name="line_number_description" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Fiscal Year1</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="fiscal_year1" name="fiscal_year1" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-3 control-label">Year1 Forecast</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="year1_forecast" name="year1_forecast" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-3 control-label">Year2 Estimate</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="year2_estimate" name="year2_estimate" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-3 control-label">Year3 Estimate</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="year3_estimate" name="year3_estimate" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-3 control-label">Year4 Estimate</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="year4_estimate" name="year4_estimate" value="">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="expense_id" name="expense_id" value="0">
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
<script src="{{asset('js/expense_ajaxscript.js')}}"></script>


