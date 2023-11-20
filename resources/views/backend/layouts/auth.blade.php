<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/dist/images/sslogo.png') }}">
    <!-- BEGIN Load CSS-->
    <link href="{{ mix('dist/css/auth.css') }}" rel="stylesheet">
    <!-- END Load CSS-->
  </head>
  <body class="horizontal-layout horizontal-top-icon-menu 1-column menu-expanded fixed-navbar" data-open="hover" data-menu="horizontal-menu" data-col="1-column">

    <!-- fixed-top-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- BEGIN Load JS-->
    <script src="{{ mix('dist/js/auth.js') }}" defer></script>
    <!-- END Load JS-->
  </body>
</html>