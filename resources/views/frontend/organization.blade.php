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
                <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab" class="menu-title">ABOUT</a></li>
                <li role="presentation"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab"  id="projects_tab">PROJECTS</a></li>
                <li role="presentation"><a href="#services" aria-controls="messages" role="tab" data-toggle="tab" id="services_tab">SERVICES</a></li>
                <li role="presentation"><a href="#money" aria-controls="money" role="tab" data-toggle="tab" id="money_tab">MONEY</a></li>
                <li role="presentation"><a href="#peoples" aria-controls="people" role="tab" data-toggle="tab" id="peoples_tab">PEOPLE</a></li>
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
                            
                                <div class="box-footer" style="height: 115px;">
                                    <div class="col-xs-3 link-div text-center">
                                    <a class="btn btn-app btn-link" href="tel:{{$organization->phone_number}}">
                                        <i class="fa md md-phone"></i> Call
                                        <div class="ripple-container"></div>
                                    </a>
                                    </div>
                                    <div class="col-xs-3 link-div text-center">
                                    <a class="btn btn-app btn-link" target="_blank" @if($organization->main_address!='') href="https://www.google.com.mm/maps/place/{{$organization->address()->first()->address_1}}, {{$organization->address()->first()->city}}, {{$organization->address()->first()->postal_code}} @endif">
                                        <i class="fa md md-place"></i> Location
                                        <div class="ripple-container"></div>
                                    </a>
                                    </div>
                                    <div class="col-xs-3 link-div text-center">
                                    <a class="btn btn-app btn-link" target="_blank" href="http://{{$organization->website}}">
                                        <i class="fa md md-link"></i> Website
                                        <div class="ripple-container"></div>
                                    </a>
                                    </div>
                                    <div class="col-xs-3 link-div text-center">
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-publish"></i> Share
                                        <div class=" sharethis-inline-share-buttons"></div>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Twitter feed</p>
                                <button class="btn btn-tweet"><a target="_blank" href="http://{{$organization->Twitter}}" class="text-white">Follow on Twitter</a></button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Facebook feed</p>
                                <button class="btn btn-facebook"><a target="_blank" href="http://{{$organization->Facebook}}" class="text-white">Follow on Facebook</a></button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Needs feed</p>
                                <button class="btn btn-rss"><a target="_blank" href="http://{{$organization->RSS}}" class="text-white">Read Their News</a></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="projects">

                </div>
                <div role="tabpanel" class="tab-pane" id="services">
 
                </div>
                <div role="tabpanel" class="tab-pane" id="money">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-budget">
                                <h5 class="box-body-operating">Expense Budget: <span class="budget-span"> ${{number_format($expense_budget)}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-budget">
                                <h5 class="box-body-operating">Capital Budget: <span class="budget-span"> ${{number_format($capital_budget)}}</span></h5>
                            </div>
                        </div> 
                    </div>
                    <div class="box">
                        <table class="table">
                            <thead>
                            <tr class="info">
                                <th class="text-left" style="padding-left: 50px;">Budget</th>
                                <th class="text-right" style="padding-right: 50px;">Year 1</th>
                                <th class="text-right" style="padding-right: 50px;">Year 2</th>
                                <th class="text-right" style="padding-right: 50px;">Year 3</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($organization_expenses as $organizaiton_expense)
                                <tr>
                                    <td class="text-left"  style="padding-left: 50px;">{{$organizaiton_expense->line_number_description}}</td>
                                    <td class="text-right" style="padding-right: 50px;">${{number_format($organizaiton_expense->year1_forecast)}}</td>
                                    <td class="text-right" style="padding-right: 50px;">${{number_format($organizaiton_expense->year2_estimate)}}</td>
                                    <td class="text-right" style="padding-right: 50px;">${{number_format($organizaiton_expense->year3_estimate)}}</td>
                                </tr>
                                @endforeach
                                <tfoot class="budget-foot">
                                    <tr class="budget-tb">
                                        <td class="text-left" style="padding-left: 50px;"><b>Total Expense Budget</b></td>
                                        <td class="text-right" style="padding-right: 50px;"><b>${{number_format($expenses_sum->expenses_year1)}}</b></td>
                                        <td class="text-right" style="padding-right: 50px;"><b>${{number_format($expenses_sum->expenses_year2)}}</b></td>
                                        <td class="text-right" style="padding-right: 50px;"><b>${{number_format($expenses_sum->expenses_year3)}}<b></td>
                                    </tr>
                                    <tr class="budget-tb">
                                        <td class="text-left" style="padding-left: 50px;"><b>Total Capital Budget</b></td>
                                        <td class="text-right" colspan="3" style="padding-right: 50px;"><b>${!! $organization->total_project_cost !!}<b></td>
                                    </tr>
                                </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div role="tabpanel" class="tab-pane" id="peoples">
                    
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="{{ asset('js/frontend/organization_projects_ajax.js') }}"></script>
<script src="{{ asset('js/frontend/organization_services_ajax.js') }}"></script>
<script src="{{ asset('js/frontend/organization_service_ajax.js') }}"></script>
<script src="{{ asset('js/frontend/organization_peoples_ajax.js') }}"></script>
<script src="{{ asset('js/frontend/organization_people_ajax.js') }}"></script>

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
