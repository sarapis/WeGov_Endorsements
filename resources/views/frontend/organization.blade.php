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
                            <span class="badge tag_badge bg-blue">{{$tag_name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge type_badge bg-blue">{{$organization_type}}</span>
                    </p>
                </div>
                <div class="pull-left org_title">{{$organization->name}}</div>
                <div class="social_icon">
                    <ul>
                        <li>@if($organization->website)
                            <a target="_blank" href="http://{{$organization->website}}" title="Website"><i class="fas fa-globe"></i></a>
                            @else
                            <a title="Website"><i class="fas fa-globe bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Facebook)
                            <a target="_blank" href="http://{{$organization->Facebook}}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @else
                            <a title="Facebook"><i class="fab fa-facebook-f bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Twitter)
                            <a target="_blank" href="http://{{$organization->Twitter}}" title="Twitter"><i class="fab fa-twitter"></i></a>
                            @else
                            <a title="Twitter"><i class="fab fa-twitter bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->RSS)
                            <a target="_blank" href="http://{{$organization->RSS}}" title="RSS"><i class="fas fa-rss"></i></a>
                            @else
                            <a title="RSS"><i class="fas fa-rss bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->phones)
                            <a href="tel: {{$organization->phones}}" title="Phone"><i class="fas fa-phone"></i></a>
                            @else
                            <a title="Phone"><i class="fas fa-phone bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->email)
                            <a href="mailto: {{$organization->email}}" title="Email"><i class="fas fa-envelope"></i></a>
                            @else
                            <a title="Email"><i class="fas fa-envelope bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->main_address)
                            <a target="_blank" href="https://www.google.com/maps/place/{{$organization->main_address}}" title="Address"><i class="fas fa-map-marker-alt"></i></a>
                            @else
                            <a title="Address"><i class="fas fa-map-marker-alt bg-disable"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
                <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
            </div>
        </div>
        <div class="menu-bar row">
            <ul class="nav nav-tabs desktop_tab" role="tablist">
                @if($entity->about == 'On')
                <li class="active"><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                @endif
                @if($entity->projects == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                @endif
                @if($entity->services == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                @endif
                @if($entity->money == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                @endif
                @if($entity->people == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                @endif
                @if($entity->laws == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">LAWS</a></li>
                @endif
                @if($entity->endorsements == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                @endif
                @if($entity->candidates == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                @endif
                @if($entity->requests == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                @endif
                @if($entity->requests_from == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                @endif
                @if($entity->indicators == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/indicators" id="indicators_tab">INDICATORS</a></li>
                @endif
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter"><i class="fa fa-bars filter-icon" aria-hidden="true"></i> About </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    @if($entity->about == 'On')
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    @endif
                    @if($entity->projects == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    @endif
                    @if($entity->services == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    @endif
                    @if($entity->money == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    @endif
                    @if($entity->people == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    @endif
                    @if($entity->laws == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">LAWS</a></li>
                    @endif
                    @if($entity->endorsements == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                    @endif
                    @if($entity->candidates == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                    @endif
                    @if($entity->requests == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                    @endif
                    @if($entity->requests_from == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                    @endif 
                    @if($entity->indicators == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/indicators" id="indicators_tab">INDICATORS</a></li>
                    @endif
                </ul>
            </div>
            
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="box">
                                <div class="org_about">
                                    <div class="col-md-12">
                                    <p>{!! $organization->organization_description !!}</p>
                                    </div>
                                    <div class="col-md-4" style="padding: 0;">
                                        <div class="box box-about">
                                            <div class="box-header text-center"><h3 class="box-title">Inputs</h3></div>
                                            <div class="box-body">
                                                <div class="col-md-12 right_about_btn">
                                                    <h5><a href="/organization_{{$organization->organizations_id}}/money"><span>${{$organization->expenses_budgets}}</span></a>Budget(E)</h5>
                                                    <h5><a href="/organization_{{$organization->organizations_id}}/money"><span>${{$organization->total_project_cost}}</span></a>Budget(C)</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding: 0;">
                                        <div class="box box-about">
                                            <div class="box-header text-center"><h3 class="box-title">Outputs</h3></div>
                                            <div class="box-body">
                                                <div class="col-md-12 right_about_btn">
                                                    <h5><a href="/organization_{{$organization->organizations_id}}/services"><span>@if($organizations_services!='')
                                                                    {{sizeof(explode(",", $organizations_services->organization_services))}}
                                                                    @else 0 @endif</span></a>Services</h5>
                                                    <h5><a href="/organization_{{$organization->organizations_id}}/projects"><span>@if($organization->projects!=null)
                                                                    {{sizeof(explode(",", $organization->projects))}}
                                                                    @else 0 @endif</span></a>Projects</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding: 0;">
                                        <div class="box box-about">
                                            <div class="box-header text-center"><h3 class="box-title">Indicators</h3></div>
                                            <div class="box-body">
                                                <div class="col-md-12 right_about_btn">
                                                    <h5><a href="/organization_{{$organization->organizations_id}}/indicators"><span>@if($desired_count)
                                                                    {{$desired_count}}
                                                                    @else 0 @endif</span></a>Desired</h5>
                                                    <h5><a href="/organization_{{$organization->organizations_id}}/indicators"><span>@if($undesired_count)
                                                                    {{$undesired_count}}
                                                                    @else 0 @endif</span></a>Undesired</h5>
                                                </div>
                                            </div>
                                        </div>
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
    <form action="/organizations" method="POST" id="organization_form" class="hidden">
        {!! csrf_field() !!}
        <input value="" id="post_value" name="post_value">
        <input value="" id="post_type" name="post_type">
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script type="text/javascript">
    $('.tag_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('tag');
        $('#post_value').val(val);
        $('#organization_form').submit();
    });
    $('.type_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('type');
        $('#post_value').val(val);
        $('#organization_form').submit();
    })
</script>
<script type="text/javascript">

    var locations = null
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
