<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <meta charset="utf-8">
          <!-- Bootstrap 3.3.7 -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/bootstrap-slider/slider.css')}}">
        <link rel="stylesheet" href="{{asset('css/material-design-lite/dist/css/AdminLTE.min.css')}}">
        <!-- Material Design -->
        <link rel="stylesheet" href="{{asset('css/material-design-lite/dist/css/bootstrap-material-design.min.css')}}">
        <link rel="stylesheet" href="http://zavoloklom.github.io/material-design-iconic-font/v1/css/material-design-iconic-font.min.css">
        
        <link rel="stylesheet" href="{{asset('css/material-design-lite/dist/css/ripples.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/css/MaterialAdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/material-design-lite/material.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/asRange.css')}}">
        <link rel="stylesheet" href="{{asset('dist/css/skins/all-md-skins.min.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/style2.css')}}">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,600,700,300italic,400italic,600italic">
        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key={{$api->find(1)->api_key}}&callback=initMap">
        </script>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </head>

    <body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
        <div id="loader" style="display: none;"></div>
        
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

            @include('partials.header')
            <main class="demo-main mdl-layout__content">
                <div class=" @if(Request::is ('/') || Request::is ('home'))  @else container @endif">
                    @yield('content')
                </div>
            </main>
            @include('partials.footer')

        </div>
        
    </body>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Material Design -->
    <script src="{{asset('dist/js/material.min.js')}}"></script>
    <script src="{{asset('dist/js/ripples.min.js')}}"></script>
    <script>
        $.material.init();
    </script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!-- Bootstrap slider -->
    <script src="{{asset('plugins/bootstrap-slider/bootstrap-slider.js')}}"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script>
      $(function () {
        /* BOOTSTRAP SLIDER */
        $('.slider').slider();
      });
    </script>

    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5ba15af942fa8c0011745dc1&product=inline-share-buttons' async='async'></script>
     <script type="text/javascript">
        var csrfToken = $('[name="csrf_token"]').attr('content');
        setInterval(refreshToken, 3600000); // 1 hour 
        function refreshToken(){
            $.get('refresh-csrf').done(function(data){
                csrfToken = data; // the new token
            });
        }
        setInterval(refreshToken, 3600000); // 1 hour 
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    @include('layouts.script')
    
</html>
