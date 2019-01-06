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
    tr.coded > td{
        background-color: green !important;
        color: white;
    }
    .pt-0{
        padding-top: 0 !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Greenbook Table
        <small>Administrator Access</small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Source URL: https://data.cityofnewyork.us/resource/25gq-py4s.json</h3>
                    </div>

                    <div class="box-body table-responsive">
                        
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="info">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Agency Name</th>
                                    <th class="text-center">Organization Code</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Agency Acronym</th>
                                    <th class="text-center">Agency Website</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Middle Initial</th>
                                    <th class="text-center">Name Suffix</th>
                                    <th class="text-center">Office Title</th>
                                    <th class="text-center">Division Name</th>
                                    <th class="text-center">Parent Division</th>
                                    <th class="text-center">Grand Parent Division</th>
                                    <th class="text-center">Great Grand Parent Division</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">City</th>
                                    <th class="text-center">State</th>
                                    <th class="text-center">Zip Code</th>
                                    <th class="text-center">Phone 1</th>
                                    <th class="text-center">Phone 2</th>
                                    <th class="text-center">Phone 1</th>
                                    <th class="text-center">Fax 1</th>
                                    <th class="text-center">Fax 2</th>
                                    <th class="text-center">Agency Primary Phone</th>
                                    <th class="text-center">Division Primary Phone</th>
                                    <th class="text-center">Section</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($greenbooks as $key => $greenbook)
                                <tr id="greenbook{{$greenbook->id}}" class="{{$greenbook->flag}}">
                                    <td class="text-center">
                                    @if(isset($_GET['page']))
                                        {{$key+15*($_GET['page']-1)+1}}</td>
                                    @else
                                        {{$key+1}}</td>
                                    @endif
                                    <td class="text-center">{{$greenbook->agency_name}}</td>
                                    <td class="text-center">{{$greenbook->organization_code}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-primary btn-sm open_modal"  value="{{$greenbook->id}}"><i class="fa fa-fw fa-edit"></i>Edit</button>
                                    </td>
                                    <td class="text-center">{{$greenbook->alternate_name}}</td>
                                    <td class="text-center">{{$greenbook->agency_acronym}}</td>
                                    <td class="text-center">{{$greenbook->agency_website}}</td>
                                    <td class="text-center">{{$greenbook->first_name}}</td>
                                    <td class="text-center">{{$greenbook->last_name}}</td>
                                    <td class="text-center">{{$greenbook->m_i}}</td>
                                    <td class="text-center">{{$greenbook->name_suffix}}</td>
                                    <td class="text-center">{{$greenbook->office_title}}</td>
                                    <td class="text-center">{{$greenbook->division_name}}</td>
                                    <td class="text-center">{{$greenbook->parent_division}}</td>
                                    <td class="text-center">{{$greenbook->grand_parent_division}}</td>
                                    <td class="text-center">{{$greenbook->great_grand_parentdivision}}</td>
                                    <td class="text-center">{{$greenbook->address}}</td>
                                    <td class="text-center">{{$greenbook->city}}</td>
                                    <td class="text-center">{{$greenbook->state}}</td>
                                    <td class="text-center">{{$greenbook->zip_code}}</td>
                                    <td class="text-center">{{$greenbook->phone_1}}</td>
                                    <td class="text-center">{{$greenbook->phone_2}}</td>
                                    <td class="text-center">{{$greenbook->fax_1}}</td>
                                    <td class="text-center">{{$greenbook->fax_2}}</td>
                                    <td class="text-center">{{$greenbook->agency_primary_phone}}</td>
                                    <td class="text-center">{{$greenbook->division_primary_phone}}</td>
                                    <td class="text-center">{{$greenbook->section}}</td>
                                    
                                </tr>
                                @endforeach                                                  
                            </tbody>
                        </table>
                        {!! $greenbooks->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>

<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Greenbook</h4>
            </div>
            <form class=" form-horizontal user" id="frmProducts" name="frmProducts"  novalidate="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Agency Name</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="agency_name" name="agency_name" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Organization Code</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="organization_code" name="organization_code" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Agency Acronym</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="agency_acronym" name="agency_acronym" value=""></input>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Agency Website</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="agency_website" name="agency_website" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">First Name</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="first_name" name="first_name" value=""></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Last Name</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="last_name" name="last_name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Middle Initial</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="m_i" name="m_i">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Name Suffix</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="name_suffix" name="name_suffix">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Office Title</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="office_title" name="office_title">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Division Name</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="division_name" name="division_name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Parent Division</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="parent_division" name="parent_division">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Grand Parent Division</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="grand_parent_division" name="grand_parent_division">
                              </div>
                            </div>                           
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Great Grand Parent Division</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="great_grand_parentdivision" name="great_grand_parentdivision">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Address</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="address" name="address">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">City</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="city" name="city">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">State</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="state" name="state">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Zip Code</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="zip_code" name="zip_code">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Phone 1</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="phone_1" name="phone_1">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Phone 2</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="phone_2" name="phone_2">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Fax 1</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="fax_1" name="fax_1">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Fax 2</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="fax_2" name="fax_2">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Agency Primary Phone</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="agency_primary_phone" name="agency_primary_phone">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label pt-0">Division Primary Phone</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="division_primary_phone" name="division_primary_phone">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-4 control-label">Section</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="section" name="section">
                              </div>
                            </div>
                        </div>
                    </div>    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                    <input type="hidden" id="greenbook_id" name="greenbook_id" value="0">
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
<script src="{{asset('js/greenbook_ajaxscript.js')}}"></script>


