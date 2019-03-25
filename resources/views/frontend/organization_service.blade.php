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
                            <span class="badge tag_badge bg-blue">{{$tag_name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge type_badge bg-blue">{{$organization->type}}</span>
                    </p>
                </div>
                <div class="pull-left org_title">{{$organization->name}}</div>
                <div class="social_icon">
                    <ul>
                        <li>@if($organization->website)
                            <a target="_blank" href="http://{{$organization->website}}" title="Website"><i class="fas fa-globe"></i></a>
                            @else
                            <a title="Website"><i class="fas fa-globe bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Facebook)
                            <a target="_blank" href="http://{{$organization->Facebook}}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @else
                            <a title="Facebook"><i class="fab fa-facebook-f bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Twitter)
                            <a target="_blank" href="http://{{$organization->Twitter}}" title="Twitter"><i class="fab fa-twitter"></i></a>
                            @else
                            <a title="Twitter"><i class="fab fa-twitter bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->RSS)
                            <a target="_blank" href="http://{{$organization->RSS}}" title="RSS"><i class="fas fa-rss"></i></a>
                            @else
                            <a title="RSS"><i class="fas fa-rss bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->phones)
                            <a href="tel: {{$organization->phones}}" title="Phone"><i class="fas fa-phone"></i></a>
                            @else
                            <a title="Phone"><i class="fas fa-phone bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->email)
                            <a href="mailto: {{$organization->email}}" title="Email"><i class="fas fa-envelope"></i></a>
                            @else
                            <a title="Email"><i class="fas fa-envelope bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->main_address)
                            <a target="_blank" href="https://www.google.com/maps/place/{{$organization->main_address}}" title="Address"><i class="fas fa-map-marker-alt"></i></a>
                            @else
                            <a title="Address"><i class="fas fa-map-marker-alt bg-disable"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
                <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
            </div>
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs desktop_tab" role="tablist">
                @if($entity->about == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                @endif
                @if($entity->projects == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                @endif
                @if($entity->services == 'On')
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                @endif
                @if($entity->money == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                @endif
                @if($entity->people == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                @endif
                @if($entity->charter == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                @endif
                @if($entity->endorsements == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                @endif
                @if($entity->candidates == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                @endif
                @if($entity->requests == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                @endif
                @if($entity->requests_from == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                @endif
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter"><i class="fa fa-bars filter-icon" aria-hidden="true"></i> Services  </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    @if($entity->about == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    @endif
                    @if($entity->projects == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    @endif
                    @if($entity->services == 'On')
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    @endif
                    @if($entity->money == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    @endif
                    @if($entity->people == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    @endif
                    @if($entity->charter == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                    @endif
                    @if($entity->endorsements == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                    @endif
                    @if($entity->candidates == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                    @endif
                    @if($entity->requests == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                    @endif
                    @if($entity->requests_from == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                    @endif
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
                                        <div class="election_menu">
                                            <div class="col-sm-12">
                                                <div class="box padding_0">
                                                    <div class="box-header">
                                                        <h3 class="box-title"><a>{{$servicename}}</a>
                                                    </div>
                                                    <div class="box-body inner_request_detail">
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <h4>Alternate Name: <p>{{$service->alternate_name}}</p></h4>
                                                                <h4>Organization: <p>{{$organization->name}}</p></h4>
                                                                <h4>Description: <p>{!! $service->description !!}</p></h4>
                                                                <h4>Status: <p> <span class="badge badge-green">{{$service->status}}</span></p></h4>
                                                                <h4>Service Category: <p>{{$taxonomy->name}}</p></h4>
                                                                <h4><a class="btn-yellow btn-sm" href="{{$service->url}}" target="_blank">Goto Website</a></h4>
                                                                <h4>Email: <p>{!! $service->email !!}</p></h4>
                                                                <h4>Program: <p></p></h4>
                                                                <br/>
                                                                <h4>Additional Info</h4>
                                                                <h4>Application Process: <p>{!! $service->application_process !!}</p></h4>
                                                                <h4>Wait Time: <p>{{$service->wait_time}}</p></h4>
                                                                <h4>Fees: <p>{{$service->fees}}</p></h4>
                                                                <h4>Accreditations: <p>{{$service->accreditations}}</p></h4>
                                                                <h4>Licenses: <p>{{$service->licenses}}</p></h4>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div id="mymap_service_profile"></div>
                                                                <h4>Address</h4>
                                                                    @if($service->locations!='')
                                                                        @foreach($service_map as $servicemap)
                                                                            <p><a href="location_{{$servicemap->location_id}}">{{$servicemap->name}}</a>: {{$servicemap->address_1}}, {{$servicemap->city}}, {{$servicemap->state_province}}, {{$servicemap->postal_code}}</p>
                                                                        @endforeach
                                                                    @endif
                                                                
                                                                <h4>Contact: <p>{{$contacts}}</p></h4>
                                                                <h4>Regular schedule: </h4>
                                                                <h4>holiday schedule: <p></p></h4>
                                                                <h4>Details:<br/> <p>@foreach($service_details as $service_detail)
                                                                    <p><span class="badge badge-yellow bg_color_badges">{{$service_detail->detail_type}}</span> {!! $service_detail->value !!}</p><br/>
                                                                @endforeach</p></h4>
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
    <form action="/organizations" method="POST" id="organization_form" class="hidden">
        {!! csrf_field() !!}
        <input value="" id="post_value" name="post_value">
        <input value="" id="post_type" name="post_type">
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script type="text/javascript">
    $('.tag_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('tag');
        $('#post_value').val(val);
        $('#organization_form').submit();
    });
    $('.type_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('type');
        $('#post_value').val(val);
        $('#organization_form').submit();
    })
</script>
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
