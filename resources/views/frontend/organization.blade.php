@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-left">{{$organization->name}}</div>
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab" class="menu-title">ABOUT</a></li>
                <li role="presentation"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">PROJECTS</a></li>
                <li role="presentation"><a href="#services" aria-controls="messages" role="tab" data-toggle="tab">SERVICES</a></li>
                <li role="presentation"><a href="#money" aria-controls="money" role="tab" data-toggle="tab">MONEY</a></li>
                <li role="presentation"><a href="#people" aria-controls="people" role="tab" data-toggle="tab">PEOPLE</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;">
                                <div class="row">
                                    <div class="col-md-8" style="padding-top: 5px;">
                                    <p>{!! $organization->organization_description !!}</p>
                                    </div>
                                    <div class="col-md-4">
                                        @if($organization->logo!='')
                                            <img src="{{$organization->logo}}" class="img-responsive center">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Operating Acitivities</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 40px;">
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-operating">NYC Services</h5>
                                                    <h3 class="box-body-operating"><b>@if($original_organization->services!='')
                                                        {{sizeof(explode(",", $original_organization->services))}}
                                                        @else 0 @endif</b></h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-operating">Capital Projects</h5>
                                                    <h3 class="box-body-operating"><b>@if($organization->projects!=null)
                                                        {{sizeof(explode(",", $organization->projects))}}
                                                        @else 0 @endif</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Total Budgets</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 40px;">
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-budget">Expense Budget</h5>
                                                    <h3 class="box-body-budget"><b>${{$organization->total_project_cost}}</b></h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-budget">Capital Budgets</h5>
                                                    <h3 class="box-body-budget"><b>${{$organization->expenses_budgets}}</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box" style="border-top: 2px solid #d2d6de;">
                               <div id="mymap"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Twitter feed</p>
                                <button class="btn btn-tweet">Tweet at NYPD</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Facebook feed</p>
                                <button class="btn btn-facebook">Follow NYPD</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">RSS Feed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="projects">
                @include('frontend.organization_projects')
                </div>
                <div role="tabpanel" class="tab-pane" id="services">
                    @if($organizations_services)
                    <div class="row">
                        <div class="col-sm-3" style="border-right:1px solid #3f3f3f; padding: 0;">
                            @include('layouts.sidebar')
                        </div>
                        <div class="col-sm-9" id="content" style="padding: 0;">
                            
                            <div class="col-sm-8">
                            @foreach($organization_services as $organization_service)
                                <div class="box box-service">
                                    <p>Category: {{$organization_service->taxonomy_name}}</p>
                                    <p class="text-aqua" id="{{$organization_service->service_id}}">{{$organization_service->name}}</p>
                                    <p>Proviced by: {{$organization->name}}</p>
                                    <p>Phone: {{$organization_service->phone_numbers}}</p>
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
                </div>
                <div role="tabpanel" class="tab-pane" id="money">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                
                <div role="tabpanel" class="tab-pane" id="people">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="{{ asset('js/frontend/organization_service_ajax.js') }}"></script>

<script type="text/javascript">

    var locations = <?php print_r(json_encode($organization_map)) ?>;


    var mymap = new GMaps({
      el: '#mymap',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value){
        if (value.latitude && value.longitude) {

            mymap.addMarker({
                lat: value.latitude,
                lng: value.longitude,
                title: value.name,
                infoWindow: {
                content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
                }
            });
        }
        if (value.project_lat && value.project_long) {
            mymap.addMarker({
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

@endsection
