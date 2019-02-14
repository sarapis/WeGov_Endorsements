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
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
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
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                @endif
                @if($entity->requests == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                @endif
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    @if($entity->about == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    @endif
                    @if($entity->projects == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    @endif
                    @if($entity->services == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
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
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                    @endif
                    @if($entity->requests == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                    @endif
                </ul>
            </div>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active candidates_tab" id="candidates_tab">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="box padding_0">
                                <div class="left_election_menu">
                                    <div class="election_head">
                                        <h3>Elections</h3>
                                        <ul role="tablist">
                                            <li class="active"><a href="#2017" data-toggle="tab">2017 Primary</a></li>
                                            <li><a href="#2013" data-toggle="tab" >2013 Primary</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content" style="padding: 0;">
                                <div role="tabpanel" class="tab-pane active" id="2017">
                                    <div class="col-sm-4">
                                        <div class="box padding_0">
                                            <div class="box-header">
                                                <h3 class="box-title">Adams, Eric L</h3>
                                            </div>
                                            <div class="box-body">
                                                <span class="org_tags">Democrats</span>
                                                <span class="org_tags">Endorsements : 3</span>
                                                <div class="candidate_detail">
                                                    <ul>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="box padding_0">
                                            <div class="box-header">
                                                <h3 class="box-title">Adams, Eric L</h3>
                                            </div>
                                            <div class="box-body">
                                                <span class="org_tags">Democrats</span>
                                                <span class="org_tags">Endorsements : 3</span>
                                                <div class="candidate_detail">
                                                    <ul>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="box padding_0">
                                            <div class="box-header">
                                                <h3 class="box-title">Adams, Eric L</h3>
                                            </div>
                                            <div class="box-body">
                                                <span class="org_tags">Democrats</span>
                                                <span class="org_tags">Endorsements : 3</span>
                                                <div class="candidate_detail">
                                                    <ul>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="2013">
                                    <div class="col-sm-4">
                                        <div class="box padding_0">
                                            <div class="box-header">
                                                <h3 class="box-title">Adams</h3>
                                            </div>
                                            <div class="box-body">
                                                <span class="org_tags">Democrats</span>
                                                <span class="org_tags">Endorsements : 3</span>
                                                <div class="candidate_detail">
                                                    <ul>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="box padding_0">
                                            <div class="box-header">
                                                <h3 class="box-title">Adams, Eric L</h3>
                                            </div>
                                            <div class="box-body">
                                                <span class="org_tags">Democrats</span>
                                                <span class="org_tags">Endorsements : 3</span>
                                                <div class="candidate_detail">
                                                    <ul>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="box padding_0">
                                            <div class="box-header">
                                                <h3 class="box-title">Adams, Eric L</h3>
                                            </div>
                                            <div class="box-body">
                                                <span class="org_tags">Democrats</span>
                                                <span class="org_tags">Endorsements : 3</span>
                                                <div class="candidate_detail">
                                                    <ul>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                        <li><span>32BJ SEIU (Service Employees International Union) Building Workers</span></li>
                                                        <li><span>Amsterdam News</span></li>
                                                        <li><span>Bay Ridge Democrats</span></li>
                                                        <li><span>Brooklyn Democrats for Change</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<script type="text/javascript">

    var locations = <?php print_r(json_encode($agency_map)) ?>;

    if (locations !== null) {
        var mymap = new GMaps({
          el: '#mymap',
          lat: locations.latitude,
          lng: locations.longitude,
          zoom:10
        });
    }
    else{
        var mymap = new GMaps({
          el: '#mymap',
          lat: 40.712722,
          lng: -74.006058,
          zoom:10
        });
    }

    if (locations !== null) {
        mymap.addMarker({
            lat: locations.latitude,
            lng: locations.longitude,
            title: locations.name,
            infoWindow: {
            content: ('<span>' +locations.address_1+', ' +locations.city+', '+locations.state_province+', '+locations.postal_code+'</span>')
            }
        });
    }

  setTimeout(function(){var iframe = $('#newsiframe');
  $('.rss2html-note',iframe.contents()).hide();},5000);

    

</script>


@endsection
