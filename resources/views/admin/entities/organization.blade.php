@extends('admin.layouts.dashboard') @section('template_title') Entity @endsection @section('template_fastload_css') @endsection @section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    tr.modified{
        background-color: red !important;
    }

    tr.modified > td{
        background-color: red !important;
        color: white;
    }
    .bg-On{
      background-color: #00a65a !important
    }
    .bg-Off{
      background-color: #605ca8 !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Entity - Organizations
        <small>Administrator Access</small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th class="text-center">Types</th>
                                    <th class="text-center">About</th>
                                    <th class="text-center">Projects</th>
                                    <th class="text-center">Services</th> 
                                    <th class="text-center">Money</th>
                                    <th class="text-center">People</th>
                                    <th class="text-center">Charter</th>
                                    <th class="text-center">Legislation</th> 
                                    <th class="text-center">Endorsements</th>
                                    <th class="text-center">Candidates</th>
                                    <th class="text-center">Requests</th>                          
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($organizations as $key => $organization)
                                <tr id="organization{{$organization->id}}" class="{{$organization->flag}}">
                                    <td class="text-center">{{$organization->types}}</td>
                                    <td class="text-center"><span class="badge bg-{{$organization->about}}">{{$organization->about}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->projects}}">{{$organization->projects}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->services}}">{{$organization->services}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->money}}">{{$organization->money}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->people}}">{{$organization->people}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->charter}}">{{$organization->charter}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->legislation}}">{{$organization->legislation}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->endorsements}}">{{$organization->endorsements}}</span></td>
                                    <td class="text-center"><span class="badge bg-{{$organization->candidates}}">{{$organization->candidates}}</td>
                                    <td class="text-center"><span class="badge bg-{{$organization->requests}}">{{$organization->requests}}</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$organization->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
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
    </section>

<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">About</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="about" name="about">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Projects</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="projects" name="projects">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Services</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="services" name="services">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Money</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="money" name="money">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">People</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="people" name="people">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Charter</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="charter" name="charter">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Legislation</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="legislation" name="legislation">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Endorsements</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="endorsements" name="endorsements">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Candidates</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="candidates" name="candidates">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="text" class="col-sm-5 control-label">Requests</label>

                      <div class="col-sm-7">
                        <input type="checkbox" style="margin-top: 10px;" id="requests" name="requests">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="id" name="id" value="0">
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
<script src="{{asset('js/entity_organization_ajaxscript.js')}}"></script>


