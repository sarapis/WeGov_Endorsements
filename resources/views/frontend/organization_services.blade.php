@if($organizations_services)
<div class="row">
    <div class="col-sm-3" style="border-right:1px solid #3f3f3f; padding: 0;">
        @include('layouts.sidebar')
    </div>
    <div class="col-sm-9" id="service_content" style="padding: 0;">
        
        <div class="col-sm-8">
        @foreach($organization_services as $organization_service)
            <div class="box box-service">
                <p>Category: {{$organization_service->taxonomy_name}}</p>
                <p class="text-aqua" id="{{$organization_service->service_id}}">{{$organization_service->name}}</p>
                <p>Proviced by: {{$organization->name}}</p>
                <p>Phone: {!! $organization_service->phone_numbers !!}</p>
            </div>
        @endforeach
        </div>
        <div class="col-sm-4">
            <div class="box" style="border-top: 2px solid #d2d6de;">
            <div id="mymap_service"></div>
        </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-danger"><strong>No Services!</strong>
</div>
@endif

<script src="{{ asset('js/frontend/organization_service_ajax.js') }}"></script>
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
                content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
                }
            });
        }
        if (value.project_lat && value.project_long) {
            mymap_service.addMarker({
                lat: value.project_lat,
                lng: value.project_long,
                title: value.project_projectid,
                infoWindow: {
                    content: ('<a style="color:red;" href="projects_'+value.project_recordid+'">'+value.project_projectid+'</a></br>')
                }
            });
        }
    });


</script>