@extends('layouts.app')
@section('title', 'Services')

@section('content')

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-3 side-filter">
            @include('layouts.service_sidebar')
        </div>
        <div class="col-sm-9 organization_right">
            <div class="col-sm-8">
                <div id="service_content">
                @foreach($organization_services as $organization_service)
                    @if($organization_service->name!=null)
                    <div class="box box-service">
                        <!-- <p class="text-aqua" id="{{$organization_service->name}}">{{$organization_service->name}}</p> -->
                        <a href="{{URL::to('organization_'.$organization_service->organization_x_id.'/services/'.$organization_service->name)}}" class="text-aqua">{{$organization_service->name}}</a>

                       <!--  <p>{{$organization_service->organization_x_id}}</p>
 -->
                        <p>Category: <span class="taxonomyid" id="{{$organization_service->taxonomy}}">{{$organization_service->taxonomy()->first()->name}}</span></p>
        
                        <p>Proviced by: <span class="organizationid" id="{{$organization_service->organization}}">{{$organization_service->organization()->first()->organization_name}}</span></p>
                        <p>Phone: {!! $organization_service->phone_numbers !!}</p>
                    </div>
                    @endif
                @endforeach
                {{ $organization_services->links() }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box" style="border-top: 2px solid #d2d6de;">
                    <div id="mymap_service"></div>
                </div>      
                <p class="search-label">Find Services Near an Address?</p>
                        
                <div class="has-feedback">
                  <span class="glyphicon glyphicon-search form-control-input"></span>
                  <div class="form-group is-empty" style="margin-top: 10px;">
                    <input type="text" class="form-control form-input" placeholder="Search Address..." id="search_address">
                  </div>        
                </div>
                <button type="button" class="btn btn_findout" id="search_location"><p class="search-label">Search</p></button>
                <button type="button" class="btn btn_findout pull-right" id="search_near"><p class="search-label">Services Near Me</p></button>
                   
                
            </div>
        </div>
    </div>
</div>

<!-- <script src="{{ asset('js/frontend/organization_service_ajax.js') }}"></script> -->
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
                maxWidth: 150,
                content: ('<a>'+value.name+'</a></br>' +value.services_address_1+', ' +value.services_address_city+', '+value.services_address_state_province+', '+value.services_address_postalcode)
                }
            });
        }
        // if (value.project_lat && value.project_long) {
        //     mymap_service.addMarker({
        //         lat: value.project_lat,
        //         lng: value.project_long,
        //         title: value.project_projectid,
        //         infoWindow: {
        //             content: ('<a style="color:red;" href="projects_'+value.project_recordid+'">'+value.project_projectid+'</a></br>')
        //         }
        //     });
        // }
    });


</script>
@endsection