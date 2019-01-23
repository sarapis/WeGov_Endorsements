
<div class="container-fluid">
    <div id="tab-general">
        <div class="mbl">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="panel">
                                <div class="panel-body">
                                    <div class="note note-info"><h4 class="box-heading" style="font-size: 25px;">{{$people->name}} @if($people->name_suffix!='') ({{$people->name_suffix}}) @endif</h4>

                                    <p><code> Organization:</code>{{$people->organization_name}}</p>
                                    <p><code> Title:</code> {{$people->office_title}}</p>
                                    <p><code> Division:</code> {{$people->division_name}}
                                    @if($people->parent_division!=''), {{$people->parent_division}}@endif @if($people->grand_parent_division!=''), {{$people->grand_parent_division}}@endif
                                    @if($people->great_grand_parent_division!=''), {{$people->great_grand_parent_division}}@endif</p>
                                    <p><code> Email:</code> {{$people->email}}</p>
                                    <p><code> Phone:</code> {{$people->phone_numbers}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="portlet box">
                                <div class="portlet-header">
                                    <div id="mymap_people"></div>
                                </div>
                                <div class="portlet-body">
                                    <p><code>Address:</code>{{$people->full_address}}</p>

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

    var mymap_people = new GMaps({
      el: '#mymap_people',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value ){
        mymap_people.addMarker({
          lat: value.latitude,
          lng: value.longitude,
          title: value.name,
         infoWindow: {
            content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
        }
   });
});

</script>