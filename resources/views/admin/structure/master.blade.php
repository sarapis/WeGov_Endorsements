<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ Lang::get('titles.app') }}</title>
    <meta name="description" content="">
    <meta name="author" content="Jeremy Kenedy">
    <meta name="_token" content="{!! csrf_token() !!}" />
    {{-- Load Layout Head --}}
    @yield('layout-head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body class="{{ isset($layoutBodybodyClasses) ? $layoutBodybodyClasses : '' }} {{ isset($templateBodybodyClasses) ? $templateBodybodyClasses : '' }}">

    {{-- Load Google Analytics --}}
    {{-- @include('blog.partials.analytics') --}}

    {{-- Load Layout HEADER --}}
    @yield('layout-header')

    {{-- Load Layout CONTENT --}}
    @yield('layout-content')

    {{-- Load Layout SIDEBAR --}}
    @yield('layout-sidebar')

    {{-- Load Layout FOOTER --}}
    @yield('layout-footer')

    {{-- Load Layout SCRIPTS --}}
    @yield('layout-scripts')

  </body>
</html>