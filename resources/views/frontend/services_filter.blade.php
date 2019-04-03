<style>
    .demo-container{
        min-height: 800px;
    }
</style>
<div id="service_content">
    @foreach($organization_services as $organization_service)
        @if($organization_service->name!=null)
        <div class="box box-service">
            <!-- <p class="text-aqua" id="{{$organization_service->name}}">{{$organization_service->name}}</p> -->

            <a href="{{URL::to('organization_'.$organization_service->organization_x_id.'/services/'.$organization_service->name)}}" class="text-aqua">{{$organization_service->name}}</a>

            <p>Category: <span class="taxonomyid" id="{{$organization_service->taxonomy}}">{{$organization_service->taxonomy()->first()->name}}</span></p>

            <p>Proviced by: <span class="organizationid" id="{{$organization_service->organization}}">{{$organization_service->organization()->first()->organization_name}}</span></p>
            <p>Phone: {!! $organization_service->phone_numbers !!}</p>
        </div>
        @endif
    @endforeach
</div>

<!-- <script src="{{ asset('js/frontend/organization_service_ajax.js') }}"></script> -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
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
    $(function () {
        var getData = function (request, response) {
            $.getJSON(
                "https://geosearch.planninglabs.nyc/v1/autocomplete?text=" + request.term,
                function (data) {
                    response(data.features);
                    
                    var label = new Object();
                    for(i = 0; i < data.features.length; i++)
                        label[i] = data.features[i].properties.label;
                    response(label);
                });
        };
     
        var selectItem = function (event, ui) {
            $("#search_address").val(ui.item.value);
            return false;
        }
     
        $("#search_address").autocomplete({
            source: getData,
            select: selectItem,
            minLength: 2,
            change: function() {
                console.log(selectItem);

            }
        });
     
    });

</script>