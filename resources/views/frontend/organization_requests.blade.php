@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')

<div class="demo-container mdl-grid inner_organization">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row ">
            <div class="col-sm-2 image_main"> 
              @if($organization->logo!='')
                  <img src="{{$organization->logo}}" class="img-responsive center" >
              @endif
            </div>
            <div class="col-sm-10 col-xs-12">
                <div class="pull-right">
                    <p class="text-tages"> Tags: <?php 
                        $tag_names = explode(',', $organization->tags);
                    ?>
                        @foreach($tag_names as $tag_name)
                            @if($tag_name!='')
                            <span class="badge bg-blue">{{$tag_name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge bg-blue">{{$organization_type}}</span>
                    </p>
                </div>
                <div class="pull-left org_title">{{$organization->name}}</div>
                <div class="social_icon">
                    <ul>
                        <li><a href="#" title="Website"><i class="fas fa-globe"></i></a></li>
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="RSS"><i class="fas fa-rss"></i></a></li>
                        <li><a href="#" title="Phone"><i class="fas fa-phone"></i></a></li>
                        <li><a href="#" title="Email"><i class="fas fa-envelope"></i></a></li>
                        <li><a href="#" title="Address"><i class="fas fa-map-marker-alt"></i></a></li>
                    </ul>
                </div>
                <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
            </div>
        </div>
        <div class="menu-bar row">
            <ul class="nav nav-tabs desktop_tab" role="tablist">
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                <li  class="active"><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/endosements" id="endosements_tab">ENDORSEMENTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="candidates_tab">CANDIDATES</a></li>
                    <li  class="active"><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="requests_tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box padding_0 table_data">
                                <div class="padding_0 endosment_table table-responsive">
                                    <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width: 10%;">Tracking Code</th>
                                                <th style="text-align: center;">Requested By</th>
                                                <th style="text-align: center;">Priority</th>
                                                <th style="text-align: center;">Request</th>
                                                <th style="text-align: center;">Requested From</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requests as $request)
                                            <tr>
                                                <td style="width: 15%;"><a href="/organization_{{$organization->organizations_id}}/requests/{{$request->tracking_code}}">{{$request->tracking_code}}</a></td>
                                                <td>{{$request->requested_by}}</td>
                                                <td style="width: 5%;">{{$request->priority}}</td>
                                                <td style="text-align: left;">{{$request->request}}</td>
                                                <td style="text-align: left;">{{$request->requested_from}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : true,
      'pageLength'  : 20,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });
} );
</script>
@endsection
