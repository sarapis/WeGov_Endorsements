@extends('layouts.app')
@section('title', 'Service')

@section('content')
<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col" style="padding-top: 0;">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-3 side-filter" style="border-right: 1px solid #3f3f3f; height: 100%;">
            <div class="row">
                @include('layouts.service_sidebar')
            </div>
        </div>
        <div class="col-sm-9" id="service_content" style="padding: 0;padding-top: 20px;">
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

                                                    <p><code> Alternate Name</code> {{$service->alternate_name}}</p>

                                                    <p><code> Organization</code><a href="/organization_{{$organization_x_id}}/services" style="color: #428bca;"> {{$organization}}</a></p>

                                                    <p><code> Description</code> {!! $service->description !!}</p>

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
                                                                <p><a>{{$servicemap->name}}</a>: {{$servicemap->services_address_1}}, {{$servicemap->services_address_city}}, {{$servicemap->services_address_state_province}}, {{$servicemap->services_address_postalcode}}</p>
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
        </div>
    </div>
</div>
<!--END PAGE WRAPPER-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script type="text/javascript">


function escapeHtml(text) {
  return text
      .replace("&amp;",'&')
      .replace("&lt;",'<')
      .replace("&gt;",'>')
      .replace("&quot;",'"')
      .replace("&#039;","'");
}


$('.taxonomy-checkbox').prop('checked',false);
$('.taxonomy-checkbox').each(function(){
    let inputval = $(this).next().text().toLowerCase();

    let ser_cate = "{{$taxonomy->name}}";
    if(inputval == escapeHtml(ser_cate).toLowerCase()){
        $(this).prop('checked',true);
    }
});

$('.services-checkbox').prop('checked',false);
$('.services-checkbox').each(function(){
    let inputval = $(this).next().text().toLowerCase();
    let ser_cate = "{{$organization}}";
    if(inputval == escapeHtml(ser_cate).toLowerCase()){
        $(this).prop('checked',true);
    }
});

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
        content: ('<a>'+value.name+'</a></br>' +value.services_address_1+', ' +value.services_address_city+', '+value.services_address_state_province+', '+value.services_address_postalcode)
    }
    });
});



</script>
@endsection
