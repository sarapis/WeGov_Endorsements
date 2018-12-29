@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-right">
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
            <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
              <p class="text-types"> Type: <span class="badge bg-blue">{{$organization_type}}</span></p>
            </div>
            <div class="pull-left">{{$organization->name}}</div>
            <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li style="width:216px;"><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li style="width:125px;"><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;min-height: 233px;">
                                <div class="row">
                                    <div class="col-md-8" style="padding-top: 5px;">
                                    <p>{!! $organization->organization_description !!}</p>
                                    </div>
                                    <div class="col-md-4">
                                        @if($organization->logo!='')
                                            <a href="http://{{$organization->website}}" target="_blank"><img src="{{$organization->logo}}" class="img-responsive center"></a>
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
                            <div class="box" style="border-top: 2px solid #d2d6de;min-height: 574px;">
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
                            <div class="box">
                                <div class="box-header"><h3 class="box-title">Twitter <a  href="{{$organization->Twitter}}" target="_blank">(profile)</a></h3></div>
                                <div class="box-body">

                                @if($organization->Twitter)
                                <div class="embed-responsive embed-responsive-16by9" style="overflow: overlay;padding-right:24px;">
                                    <a class="twitter-timeline" href="{{$organization->Twitter}}?ref_src=twsrc%5Etfw">Tweets by NYCSanitation</a> 
                                     <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                </div>
                                @elseif($organization->RSS || $organization->Facebook)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <p class="box-body-operating link-txt" style="padding-top: 50%;">We don’t know the Twitter profile of this organization. <br>If you do please <a href="http://mygov.nyc/contact" target="_blank">let us know</a>.</p>
                                    </div>
                                @else
                                    <p class="box-body-operating link-txt">We don’t know the Twitter profile of this organization. <br>If you do please <a href="http://mygov.nyc/contact" target="_blank">let us know</a>.</p>
                                @endif
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box">
                                <div class="box-header"><h3 class="box-title">Facebook <a href="{{$organization->Facebook}}" target="_blank">(page)</a></h3></div>
                                <div class="box-body">
                                    @if($organization->Facebook)
                                    <aside class="widget--facebook--container">
                                        <div class="widget-facebook">
                                          <iframe id="facebook_iframe" class="facebook_iframe"></iframe>
                                        </div>
                                    </aside>
                                    <style type="text/css">
                                        .widget--facebook--container {
                                          padding: 0px;
                                        }

                                        .widget-facebook {
                                          height: 500px;
                                        }

                                        .widget-facebook .facebook_iframe {
                                          border: none;
                                        }
                                    </style>
                                    <script type="text/javascript">
                                        function setupFBframe(frame) {
                                          var container = frame.parentNode;

                                          var facebooklink = <?php print_r(json_encode($organization->Facebook)) ?>;

                                          var containerWidth = container.offsetWidth;
                                          var containerHeight = container.offsetHeight;

                                          var src =
                                            "https://www.facebook.com/plugins/page.php" +
                                            "?href="+facebooklink+
                                            "&tabs=timeline" +
                                            "&width=" +
                                            containerWidth +
                                            "&height=" +
                                            containerHeight +
                                            "&small_header=false" +
                                            "&adapt_container_width=true" +
                                            "&hide_cover=false" +
                                            "&hide_cta=true" +
                                            "&show_facepile=true" +
                                            "&appId";

                                          frame.width = containerWidth;
                                          frame.height = containerHeight;
                                          frame.src = src;
                                        }

                                        /* begin Document Ready                                             
                                        ############################################ */

                                        document.addEventListener('DOMContentLoaded', function() {
                                          var facebookIframe = document.querySelector('#facebook_iframe');
                                          setupFBframe(facebookIframe);
                                         
                                          /* begin Window Resize                                            
                                          ############################################ */
                                          
                                          // Why resizeThrottler? See more : https://developer.mozilla.org/ru/docs/Web/Events/resize
                                          (function() {
                                            window.addEventListener("resize", resizeThrottler, false);

                                            var resizeTimeout;

                                            function resizeThrottler() {
                                              if (!resizeTimeout) {
                                                resizeTimeout = setTimeout(function() {
                                                  resizeTimeout = null;
                                                  actualResizeHandler();
                                                }, 66);
                                              }
                                            }

                                            function actualResizeHandler() {
                                              document.querySelector('#facebook_iframe').removeAttribute('src');
                                              setupFBframe(facebookIframe);
                                            }
                                          })();
                                          /* end Window Resize
                                          ############################################ */
                                        });
                                    </script>
                                    @elseif($organization->Twitter || $organization->RSS)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <p class="box-body-operating link-txt" style="padding-top: 50%;">We don’t know the Facebook page of this organization. <br>If you do please <a href="http://mygov.nyc/contact" target="_blank">let us know</a>.</p>
                                    </div>
                                    @else
                                    <p class="box-body-operating link-txt">We don’t know the Facebook page of this organization. <br>If you do please <a href="http://mygov.nyc/contact" target="_blank">let us know</a>.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box">
                                <div class="box-header"><h3 class="box-title">News <a  href="http://{{$organization->RSS}}" target="_blank">(feed)</a></h3></div>
                                <div class="box-body">
                                    
                                    @if($organization->RSS)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" frameborder="0" src="//rss.bloople.net/?url=http://{{$organization->RSS}}feed%2F&detail=&type=html" scrolling="yes" allowfullscreen id="newsiframe"></iframe>
                                    </div>
                                    @elseif($organization->Twitter || $organization->Facebook)
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <p class="box-body-operating link-txt" style="padding-top: 50%;">We don’t know the News feed of this organization. <br>If you do please <a href="http://mygov.nyc/contact" target="_blank">let us know</a>.</p>
                                        </div>
                                    @else
                                        <p class="box-body-operating link-txt">We don’t know the News feed of this organization. <br>If you do please <a href="http://mygov.nyc/contact" target="_blank">let us know</a>.</p>
                        
                                    @endif

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
