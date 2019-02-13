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
                        $tag_names = explode(',', $organization->tags);
                    ?>
                        @foreach($tag_names as $tag_name)
                            @if($tag_name!='')
                            <span class="badge bg-blue">{{$tag_name}}</span>
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
                <li class="active"><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                </ul>
            </div>
            
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="box">
                                <div class="org_about">
                                    <div class="col-md-8">
                                    <p>{!! $organization->organization_description !!}</p>
                                    </div>
                                    <div class="col-md-4 right_about_btn">
                                        <h5><a href="/organization_{{$organization->organizations_id}}/services"><span>@if($organizations_services!='')
                                                        {{sizeof(explode(",", $organizations_services->organization_services))}}
                                                        @else 0 @endif</span></a>Services</h5>
                                        <h5><a href="/organization_{{$organization->organizations_id}}/projects"><span>@if($organization->projects!=null)
                                                        {{sizeof(explode(",", $organization->projects))}}
                                                        @else 0 @endif</span></a>Projects</h5>
                                        <h5><a href="/organization_{{$organization->organizations_id}}/money"><span>${{$organization->expenses_budgets}}</span></a>Budget(E)</h5>
                                        <h5><a href="/organization_{{$organization->organizations_id}}/money"><span>${{$organization->total_project_cost}}</span></a>Budget(C)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box">
                               <div id="mymap"></div>
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
