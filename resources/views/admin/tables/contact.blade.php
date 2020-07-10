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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Name Suffix</th>
                                    <th class="text-center">Office Title</th>
                                    <th class="text-center">Division Name</th>
                                    <th class="text-center">Parent Division</th>
                                    <th class="text-center">Grand Parent Division</th>
                                    <th class="text-center">Great Grand Parent Division</th>  
                                    <th class="text-center">Full address</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Section</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $key => $contact)
                                <tr id="contact{{$contact->id}}" class="{{$contact->flag}}">
                                    <td class="text-center">{{$contact->id}}</td>
                                    <td class="text-center">{{$contact->name}}</td>
                                    <td class="text-center">{{$contact->name_suffix}}</td>
                                    <td class="text-center">{{$contact->office_title}}</td>
                                    <td class="text-center">{{$contact->division_name}}</td>
                                    <td class="text-center">{{$contact->parent_division}} 
                                    <td class="text-center">{{$contact->grand_parent_division}}       
                                    <td class="text-center">{{$contact->great_grand_parent_division}}</td>
                                    <td class="text-center">{{$contact->full_address}}</td>
                                    <td class="text-center">{{$contact->email}}</td>
                                    <td class="text-center">{{$contact->section}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$contact->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $contacts->links() !!}
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
                <h4 class="modal-title">Contacts</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" name="name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Name Suffix</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="name_suffix" name="name_suffix" value=""></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Office Title</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="office_title" name="office_title" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Division Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="division_name" name="division_name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Parent Division</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="parent_division" name="parent_division" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Grand Parent Division</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="grand_parent_division" name="grand_parent_division" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Great Grand Parent Division</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="great_grand_parent_division" name="great_grand_parent_division" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Full address</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="full_address" name="full_address" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Email</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="email" name="email" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Section</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="section" name="section" value="">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="contact_id" name="contact_id" value="0">
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
<script src="{{asset('js/contact_ajaxscript.js')}}"></script>


