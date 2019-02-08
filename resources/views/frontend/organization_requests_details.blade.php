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
                        $tag_names = explode(',', $organization->tag_names);
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
                <li><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
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
                    <li><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/endosements" id="endosements_tab">ENDORSEMENTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="candidates_tab">CANDIDATES</a></li>
                    <li  class="active"><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="requests_tab">
                    <div class="row">
                        <div class="election_menu">
			                <div class="col-sm-12">
			                    <div class="box padding_0">
			                        <div class="box-header">
			                            <h3 class="box-title"><a href="/elections_detail">Tracking Code : 101201901C</a></h3>
			                        </div>
			                        <div class="box-body inner_request_detail">
			                        	<div class="row">
			                        		<div class="col-sm-7">
			                            		<h4>Borough: <p>Bronx</p></h4>
			                            		<h4>Community District: <a class="blue_color" href="#">Community District 1</a></h4>
			                            		<h4>Priority Number: <p>01</p></h4>
			                            		<h4>Request: <p>Build new, expand or repair storm...</p></h4>
			                            		<h4>Explanation: <p>Allocated funds for capital sewer work to be performed in the area located on Beekman Avenue</p></h4>
			                            		<h4>Responsible Agency : <a class="blue_color" href="#">Department of Environmental</a></h4>
			                            		<h4>Response: <p>OMB supports the agency's position as follows: More information is needed from the community board before making a funding decision...</p></h4>
			                            		<h4>Budget Line: <p>sdsnsdsdjs</p></h4>
			                            		<h4>Project ID: <a class="blue_color" href="#">1204678C</a></h4>
			                            		<h4>Supported By: <a class="blue_color" href="#">annasajajjjshjahs</a></h4>
			                            	</div>
			                            	<div class="col-sm-5">
								                <div id="mymap"></div>
								                <br/>
								                <h4>Location Name: <p></p></h4>
			                            		<h4>Location Address: <p>Beekman Avenue</p></h4>
			                            		<h4>Cross Street 1: <p>East 141st Street</p></h4>
			                            		<h4>Cross Street 2: <p>st. Ann's Avenue</p></h4>
			                            		<h4>Site Block: <p></p></h4>
			                            		<h4>LOT: <p></p></h4>
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


@include('layouts.script')
@endsection
