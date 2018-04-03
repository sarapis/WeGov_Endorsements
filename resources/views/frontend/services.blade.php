@include('layouts.style')
<title>Services</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="../css/treeview.css" rel="stylesheet">
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

        <!--BEGIN PAGE WRAPPER-->
        <div id="wrapper">
        <div id="page-wrapper">
            @include('layouts.sidebar')
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title plxxl">
                        Services</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="/">Services</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
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
                                <div class="col-lg-12">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-8 plxl">
                                                    <div class="row">
                                                        <form action="/services_find" method="POST" class="hidden-sm hidden-xs" style="display: block !important; padding-bottom: 30px;padding: 5px;width: 300px;">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="input-icon right text-white"><a href=""><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control text-black" name="find"/></div>
                                                        </form>
                                                    </div>
                                                    <div class="row pal">
                                                        <h3>Services Category</h3>
                                                        <ul id="tree1">
                                                            @foreach($taxonomies as $taxonomy)
                                                                <li>
                                                                    <a href="category_{{$taxonomy->taxonomy_id}}">{{$taxonomy->name}}</a>
                                                                    @if(count($taxonomy->childs))
                                                                        @include('layouts.manageChild',['childs' => $taxonomy->childs])
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div id="mymap" style="width: 100%;"></div>
                                                </div>
                                            </div>                            
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
@include('layouts.script')
<script src="../js/treeview.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5XHJ6oNL9-qh0XsL0G74y1xbcxNGkSxw&callback=initMap"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
 <script type="text/javascript">

    var locations = <?php print_r(json_encode($location_map)) ?>;

    var mymap = new GMaps({
      el: '#mymap',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value ){
        mymap.addMarker({
          lat: value.latitude,
          lng: value.longitude,
          title: value.name,
         
        infoWindow: {
            content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
        }

        });
   });

  </script>

