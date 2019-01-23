@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-right hidden-xs">
              <p class="text-tages"> Tags: <?php 
                $tag_names = explode(',', $organization->tag_names);
                ?>
              @foreach($tag_names as $tag_name)
                @if($tag_name!='')
                  <span class="badge bg-green">
                    {{$tag_name}}</span>
                @endif
              @endforeach</p>
            </div>
            <div class="pull-right hidden-xs" style="padding-left: 20px;padding-right: 10px;">
              <p class="text-types"> Type: <span class="badge bg-blue">{{$organization->type}}</span></p>
            </div>
            <div class="pull-left">{{$organization->name}}</div>
            <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li style="width:216px;"><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li style="width:125px;"><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
            </ul>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="services">
                    <div class="row">
                      <div class="col-sm-12" id="service_content" style="padding: 0;">
                          
                          <div class="col-sm-8">
                          @if($organizations_services)
                              @foreach($organization_services as $organization_service)
                                  <div class="box box-service">
                                      <p>Category: {{$organization_service->taxonomy_name}}</p>
                                      <p class="text-aqua"><a href="/organization_{{$organization->organizations_id}}/services/{{$organization_service->name}}">{{$organization_service->name}}</a></p>
                                      <p>Proviced by: {{$organization->name}}</p>
                                      <p>Phone: {!! $organization_service->phone_numbers !!}</p>
                                  </div>
                              @endforeach

                          @else
                          <div class="alert alert-danger"><strong>No Services!</strong>
                          </div>
                          @endif
                          </div>
                          <div class="col-sm-4">
                              <div class="box" style="border-top: 2px solid #d2d6de;">
                              <div id="mymap_service"></div>
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

    var locations = <?php print_r(json_encode($organization_map)) ?>;


    var mymap_service = new GMaps({
      el: '#mymap_service',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value){
        if (value.latitude && value.longitude) {

            mymap_service.addMarker({
                lat: value.latitude,
                lng: value.longitude,
                title: value.name,
                infoWindow: {
                content: (value.name+'</br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
                }
            });
        }
        if (value.project_lat && value.project_long) {
            mymap_service.addMarker({
                lat: value.project_lat,
                lng: value.project_long,
                title: value.project_projectid,
                infoWindow: {
                    content: (value.project_recordid+','+value.project_projectid+'</br>')
                }
            });
        }
    });


</script>




@endsection
