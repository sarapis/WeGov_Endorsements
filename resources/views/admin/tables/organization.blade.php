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
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Contacts</th>
                                    <th class="text-center">Website</th>
                                    <th class="text-center">Short Description</th>
                                    <th class="text-center">Logo</th>  
                                    <th class="text-center">Checkbook</th>
                                    <th class="text-center">Internalnotes</th>
                                    <th class="text-center">Contacts link</th>
                                    <th class="text-center">Services</th>
                                    <th class="text-center">Phones</th>
                                    <th class="text-center">Loactions</th>
                                    <th class="text-center">Contact</th>
                                    <th class="text-center">Dedupe</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($organizations as $key => $organization)
                                <tr id="organization{{$organization->id}}" class="{{$organization->flag}}">
                                    <td class="text-center">{{$organization->id}}</td>
                                    <td class="text-center">{{$organization->organizations_id}}</td>
                                    <td class="text-center">{{$organization->alternate_name}}</td>
                                    <td class="text-center">{{$organization->name}}</td>
                                    <td class="text-center"><span class="badge bg-purple">{{$organization->type}}</span></td>

                                    <td class="text-center">@if($organization->contacts==null)
                                      0
                                     @else
                                      {{sizeof(explode(",", $organization->contacts))}}
                                      @endif
                                    </td>
                                    <td class="text-center">{{str_limit($organization->website, 15)}}</td>
                                    <td class="text-center">{{str_limit($organization->description, 30)}}</td>
                                    <td class="text-center">
                                    @if($organization->logo!=null)
                                    <img src="{{$organization->logo}}" style="width: 40px;">
                                    @endif
                                    </td>
                                    <td class="text-center">{{str_limit($organization->checkbook, 15)}}</td>
                                    <td class="text-center">{{$organization->internalnote}}</td>
                                    <td class="text-center">{{str_limit($organization->contacts_link, 15)}}</td>
                                    <td class="text-center">@if($organization->services==null)
                                      0
                                     @else
                                      {{sizeof(explode(",", $organization->services))}}
                                      @endif
                                    </td>
                                    <td class="text-center">@foreach($organization->phone as $phone)
                                      <span class="badge bg-green">{{$phone->phone_number}}
                                    @endforeach
                                    </span></td>
                                    <td class="text-center">
                                    @foreach($organization->location as $location)
                                      <span class="badge bg-yellow">{{$location->name}}</span>
                                    @endforeach
                                    </td>
                                    <td class="text-center">{{$organization->contact}}</td>
                                    <td class="text-center">@if($organization->dedupe==1)
                                      <i class="icon fa fa-check"></i>
                                      @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$organization->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $organizations->links() !!}
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
                <h4 class="modal-title">Organizations</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">ID</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="organizations_id" name="organizations_id" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Alternate Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="alternate_name" name="alternate_name" value=""></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Name</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" name="name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Type</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="type" name="type" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label" style="padding-top: 0;">Website</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="website" name="website" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label">Short Description</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="description" name="description" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Logo</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="logo" name="logo" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Checkbook</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="checkbook" name="checkbook" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Internalnotes</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="internalnotes" name="internalnotes" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Contacts link</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="contacts_link" name="contacts_link" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-4 control-label">Dedute</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="dedupe" name="dedupe">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="organization_id" name="organization_id" value="0">
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
<script src="{{asset('js/organization_ajaxscript.js')}}"></script>


