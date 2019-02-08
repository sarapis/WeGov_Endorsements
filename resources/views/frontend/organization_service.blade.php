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
                            <span class="badge bg-green">{{$tag_name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge bg-blue">{{$organization->type}}</span>
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
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="endorsements_tab">ENDORSEMENTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="candidates_tab">CANDIDATES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                </ul>
            </div>
            
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="services">
                    <div id="wrapper">
                        <!--BEGIN PAGE WRAPPER-->
                            <div id="page-wrapper">

                                <!--END TITLE & BREADCRUMB PAGE-->
                                <div id="tab-general">
                                    <div class="mbl">
                                        <div class="col-lg-12">

                                            <div class="col-md-12">
                                                <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                                                </div>
                                            </div>

                                        </div>

                                        <div>
                                            <div class="page-content">
                                                <div class="container-fluid" style="padding:0 !important;">
                                                    <div class="col-lg-8">
                                                        <div class="panel" style="padding-top: 20px;">
                                                            <div class="panel-body">
                                                                <p style="font-size: 25px;color: #357ca5;">{{$servicename}}</p>

                                                                <p><code> Alternate Name</code>{{$service->alternate_name}}</p>

                                                                <p><code> Organization</code> {{$organization->name}}</p>

                                                                <p><code> Description</code>{!! $service->description !!}</p>

                                                                <p><code> Status</code><span class="badge badge-green">{{$service->status}}</span></p>

                                                                <p><code> Service Category</code> {{$taxonomy->name}}</p>

                                                                <a class="btn-yellow btn-sm" href="{{$service->url}}" target="_blank">Goto Website</a>

                                                                <p style="padding-top: 12px;"><code> Email:</code>{!! $service->email !!}</p>

                                                                <p><code> Program</code></p>

                                                                <div class="divider">
                                                                    <h4>Additional Info</h4>
                                                                    <p><code> Application Process</code>{!! $service->application_process !!}</p>
                                                                    <p><code> Wait Time</code>{{$service->wait_time}}</p>
                                                                    <p><code> Fees</code>{{$service->fees}}</p>
                                                                    <p><code> Accreditations</code>{{$service->accreditations}}</p>
                                                                    <p><code> Licenses</code>{{$service->licenses}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="portlet box">
                                                            <div class="portlet-header">

                                                                    <div id="mymap_service_profile"></div>

                                                            </div>
                                                            <div class="portlet-body">
                                                                <p><code>Address</code></p>
                                                                    @if($service->locations!='')
                                                                        @foreach($service_map as $servicemap)
                                                                            <p><a href="location_{{$servicemap->location_id}}">{{$servicemap->name}}</a>: {{$servicemap->address_1}}, {{$servicemap->city}}, {{$servicemap->state_province}}, {{$servicemap->postal_code}}</p>
                                                                        @endforeach
                                                                    @endif
                                                                <p><code>Contact</code>{{$contacts}}</p>
                                                                <p><code>Regular schedule</code></p>
                                                                <p><code>holiday schedule</code></p>
                                                                <h4>Details</h4>
                                                                @foreach($service_details as $service_detail)
                                                                    <p><span class="badge badge-yellow">{{$service_detail->detail_type}}</span> {!! $service_detail->value !!}</p>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--END CONTENT-->

                        </div>
                        <!--END PAGE WRAPPER-->
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script type="text/javascript">

var locations = <?php print_r(json_encode($service_map)) ?>;

var mymap_service_profile = new GMaps({
  el: '#mymap_service_profile',
  lat: 40.712722,
  lng: -74.006058,
  zoom:10
});

$.each( locations, function( index, value ){
    mymap_service_profile.addMarker({
      lat: value.latitude,
      lng: value.longitude,
      title: value.name,
     infoWindow: {
        content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
    }
    });
});

</script>
@endsection
