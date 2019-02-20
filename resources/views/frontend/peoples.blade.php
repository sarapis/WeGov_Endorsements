@extends('layouts.app')
@section('title', 'People')
@section('content')

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-3 side-filter">
            @include('layouts.sidebar')
        </div>
        <div class="col-sm-9 organization_right people" id="organization_content">
            <div class="">
                @foreach ($peoples as $people)
                <div class="col-sm-4 col-md-4 col-xs-6">
                    <div class="org_inner_right inner_people">
                        <div class="org_img">
                            <img src="{{asset('images/image.jpg')}}" class="img-responsive center" >
                        </div>
                        <a href="/people_{{$people->id}}">{{$people->first_name}} {{$people->last_name}}</a>
                        <p>{{$people->office_title}}, {{$people->organization_name}} {{$people->division_name}}
                        @if($people->parent_division!=''), {{$people->parent_division}}@endif @if($people->grand_parent_division!=''), {{$people->grand_parent_division}}@endif
                        @if($people->great_grand_parent_division!=''), {{$people->great_grand_parent_division}}@endif</p>
                    </div>
                </div>
                @endforeach
            </div>
            <dir class="text-right col-sm-12" style="float: right;width: 100%;">
                {{$peoples->links()}}
            </dir>
        </div>
    </div>
</div>

{{-- 
    <!--BEGIN PAGE WRAPPER-->
    <!-- <div id="wrapper">
        <div id="page-wrapper">
            @include('layouts.sidebar')
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title plxxl">
                        People</div>
                </div>
                <div class="col-sm-4" style="padding-left: 200px;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Organization @if($organization_type!=''): {{$organization_type}}@endif
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu scrollable-menu">
                            @foreach ($organization as $organization)
                            <li><a href="/organizationtype_{{$organization->organization_name}}">{{$organization->organization_name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
            <div id="tab-general">
                <div class="mbl">
                    <div class="col-lg-12">

                        <div class="col-md-12">
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                        </div>

                    </div>

                    <div>
                        <button class="cornsilk btn-blue" style="position: absolute;top: 7px;left: auto;" id="menu-toggle">
                            <a href="" class="btn btn-secondary" style="padding: 0px;font-size: 25px;"><i class="fa  fa-search" style="color: #fff;font-size: 25px;"></i></a>
                        </button>
                   
                        <div class="page-content">
                            <div class="panel panel-blue">
                                <div class="panel-body"  style="overflow-x:auto;">
                                    <table id="example" class="table table-striped table-hover table-bordered display nowra" cellspacing="0" width="100%">
                                        <thead>
                                          <tr class="info">
                                            <th>@sortablelink('name', 'Name')</th>
                                            <th>Organization</th>
                                            <th>Title</th>
                                            <th>Division</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($peoples as $people)
                                          <tr>
                                            <td><a href="/people_{{$people->contact_id}}"> {{$people->name}}</a></td>
                                            <td><a href="/organization_{{$people->organizations_id}}">{{$people->organization_name}}</a></td>
                                            <td>{{$people->office_title}}</td>
                                            <td>{{$people->division_name}}
                                            @if($people->parent_division!=''), {{$people->parent_division}}@endif @if($people->grand_parent_division!=''), {{$people->grand_parent_division}}@endif
                                            @if($people->great_grand_parent_division!=''), {{$people->great_grand_parent_division}}@endif</td>
                                          </tr> 
                                          @endforeach
                                        </tbody>
                                    </table>
                                    <dir class="text-right">
                                        {{$peoples->links()}}
                                    </dir>
                                </div>  
                            </div>
                        </div>
                    </div>                 
                </div>
            </div>

            <div id="footer">
                <div class="copyright">
                    <a href="#">&copy; ThemesGround 2015. Designed by ThemesGround </a></div>
            </div>
        </div>
    </div> -->
<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "pageLength": 25
        "scrollX": true
    });
} );
</script> --> --}}
@include('layouts.script')
@endsection
