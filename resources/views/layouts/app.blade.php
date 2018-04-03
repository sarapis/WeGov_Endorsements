<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta charset="utf-8">
      <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="css/material-design-lite/dist/css/AdminLTE.min.css">
    <!-- Material Design -->
    <link rel="stylesheet" href="css/material-design-lite/dist/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="http://zavoloklom.github.io/material-design-iconic-font/v1/css/material-design-iconic-font.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/material-design-lite/dist/css/ripples.min.css">
    <link rel="stylesheet" href="css/material-design-lite/material.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="css/material-design-lite/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,600,700,300italic,400italic,600italic">
    <script src="{{asset('script/jquery-1.10.2.min.js')}}"></script>
</head>

<body>

    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

        @include('partials.header')
        <div class="demo-ribbon"></div>
        @include('partials.sidebar')

        <main class="demo-main mdl-layout__content">
            @yield('content')
        </main>

    </div>

    <script src="script/jquery-migrate-1.2.1.min.js"></script>
    <script src="script/jquery-ui.js"></script>
    <script src="script/bootstrap.min.js"></script>
    
<!--     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQxoWuYlm64PCZk4GVupcugr-MC9odMgY&callback=initMap">
    </script> -->
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script> -->
<!--     <script>
      function initMap() {
        var uluru = {lat: 40.712722, lng: -74.006058};
        var map = new google.maps.Map(document.getElementById('mymap'), {
          zoom: 10,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script> -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBC4sA0zmg1sTd4hjznSoLrVg7UAx17GpE&callback=initMap">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5XHJ6oNL9-qh0XsL0G74y1xbcxNGkSxw&callback=initMap">
    </script>

    

</html>
