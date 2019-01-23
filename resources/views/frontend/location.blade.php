@include('layouts.style')
<title>{{$location->name}} | Location</title>

<div>

    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN TOPBAR-->
     @include('layouts.header')
    <!--END TOPBAR-->

        <!--BEGIN SIDEBAR MENU-->
        @include('layouts.menu')
        <!--END SIDEBAR MENU-->
        <div id="wrapper">
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            @include('layouts.sidebar')
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title plxxl">
                        Location</div>
                </div>
                <div class="sharethis-inline-share-buttons col-md-4"></div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-map-marker"></i>&nbsp;<a href="/location">Locations</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">{{$location->name}}</li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
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
                    <button class="cornsilk btn-blue" style="position: absolute;top: 7px;left: auto;" id="menu-toggle">
                        <a href="" class="btn btn-secondary" style="padding: 0px;font-size: 25px;"><i class="fa  fa-search" style="color: #fff;font-size: 25px;"></i></a>
                    </button>
                    
                        <div class="page-content">
                            <div class="row">
                                <div class="col-lg-8" style="padding: 0;">

                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="note note-info"><h4 class="box-heading" style="font-size: 25px;">{{$location->name}}</h4>

                                            <p><code> Organization:</code><a href="organization_{{$location->organizations_id}}">{{$location->organization_name}}</a></p>
                                            <p><code> Service:</code><a href="service_{{$location->service_id}}">{{$location->service_name}}</a></p>
                                            <p><code> Alternate Name:</code> {{$location->alternate_name}}</p>
                                            <p><code> Description:</code> {!! $location->description !!}</p>
                                            <p><code> Transportation:</code> {{$location->transportation}}</p>
                                            <p><code> Phones:</code> {{$location->phone_numbers}}</p>

                                            </div>
                                            <div id="grid-layout-table-1" class="box jplist">
                                                <div class="jplist-ios-button"><i class="fa fa-sort"></i>Display Options</div>
                                                <div class="jplist-panel box panel-top">
                                                    <button type="button" data-control-type="reset" data-control-name="reset" data-control-action="reset" class="jplist-reset-btn btn btn-default">Reset<i class="fa fa-share mls"></i></button>
                                                    <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-number="3"> 3 per page</span></li>
                                                            <li><span data-number="5"> 5 per page</span></li>
                                                            <li><span data-number="10" data-default="true"> 10 per page</span></li>
                                                            <li><span data-number="all"> view all</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-path="default">Sort by</span></li>
                                                            <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                                            <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                                                            <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                                                            <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                                                            <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
                                                            <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
                                                            <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                                                            <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
                                                    <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" class="jplist-pagination"></div>
                                                </div>
                                                
                                                <div class="box text-shadow">
                                                    <table class="demo-tbl">
                                                        <!--<item>1</item>-->
                                                       @foreach($location_services as $location_service)
                                                        <tr class="tbl-item">
                                                            
                                                            <!--<data></data>-->
                                                            <td class="td-block">

                                                                <p class="title" style="font-size: 25px;"><a href="/service_{{$location_service->service_id}}" style="color: #357ca5;">{{$location_service->name}}</a></p>

                                                                <p class="desc" style="font-size: 16px;"><a href="#" style="color: #00aff0;"></a></p>

                                                                <div class="option" style="padding-left: 10px;padding-top: 5px;">

                                                                    <p class="desc" style="font-size: 16px; color: #000;"><i class="fa fa-fw fa-sitemap"></i>{{$location_service->taxonomy_name}}</p>

                                                                    <p class="desc" style="font-size: 16px; color: #000;"><i class="fa fa-fw fa-phone-square"></i>{!! $location_service->phone_numbers !!}</p>

                                                                    <p class="desc" style="font-size: 16px;">{!! $location_service->description !!}</p>
                                                                </div>
                                                            </td>
                                                            <!--<img/>-->
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                                
                                                <div class="box jplist-no-results text-shadow align-center">
                                                    <p>No results found</p>
                                                </div>
                                                <div class="jplist-ios-button"><i class="fa fa-sort"></i>jPList Actions</div>
                                                <div class="jplist-panel box panel-bottom">
                                                    <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-number="3"> 3 per page</span></li>
                                                            <li><span data-number="5"> 5 per page</span></li>
                                                            <li><span data-number="10" data-default="true"> 10 per page</span></li>
                                                            <li><span data-number="all"> view all</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-control-animate-to-top="true" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-path="default">Sort by</span></li>
                                                            <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                                            <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                                                            <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                                                            <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                                                            <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
                                                            <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
                                                            <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                                                            <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-type="{start} - {end} of {all}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
                                                    <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-pagination"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4" style="padding: 0;">
                                    <div class="portlet box">
                                        <div class="portlet-header">
                                            <div id="mymap" style="width: 100%;"></div>
                                        </div>
                                        <div class="portlet-body">
                                            <p><code>Address</code>{{$location_map->address_1}}, {{$location_map->city}}, {{$location_map->state_province}}, {{$location_map->postal_code}}</p>
                                            <p><code>Regular schedule</code></p>
                                                <p style="margin-left: 20px;"><span class="badge badge-yellow">Weekday</span> {{$location_map->weekday}}</p>
                                                <p style="margin-left: 20px;"><span class="badge badge-yellow">Opens_at</span> {{$location_map->opens_at}}</p>
                                                <p style="margin-left: 20px;"><span class="badge badge-yellow">Closes_at</span> {{$location_map->closes_at}}</p>
                                            <p><code>Holiday schedule</code></p>

                                            
                                            
                                                <p><span class="badge badge-yellow"></span> </p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">
                <a href="#">&copy; ThemesGround 2015. Designed by ThemesGround </a></div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END CONTENT-->

</div>
<!--END PAGE WRAPPER-->
</div>
</div>
@include('layouts.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript">

    var location_map = <?php print_r(json_encode($location_map)) ?>;
    var latitude = <?php print_r(json_encode($location_map->latitude)) ?>;
    var longitude = <?php print_r(json_encode($location_map->longitude)) ?>;
    var name = <?php print_r(json_encode($location_map->name)) ?>;
    var address_1 = <?php print_r(json_encode($location_map->address_1)) ?>;
    var city = <?php print_r(json_encode($location_map->city)) ?>;
    var state_province = <?php print_r(json_encode($location_map->state_province)) ?>;
    var postal_code = <?php print_r(json_encode($location_map->postal_code)) ?>;
    var mymap = new GMaps({
      el: '#mymap',
      lat: latitude,
      lng: longitude,
      zoom:18
    });

        mymap.addMarker({
          lat: latitude,
          lng: longitude,
          title: name,
          infoWindow: {
              content: (name+'</br>' +address_1+', ' +city+', '+state_province+', '+postal_code)
        }

   });

  </script>