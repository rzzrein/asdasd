<!DOCTYPE html>
<html lang="en" style="height: auto;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="SS">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="url" content="{{ url('') }}">
        <title>{{ isset($title)?$title." | ":"" }}Dashboard {{ env('APP_NAME') }}</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ url('/images/favicon.ico') }}">
        @if ($darkmode)
		<link rel="stylesheet" href="{{ mix('dist/metronic/css/style.dark.bundle.css') }}">
        @else
		<link rel="stylesheet" href="{{ mix('dist/metronic/css/style.bundle.css') }}">
        @endif
		<link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">

    </head>

	<body class="layout-navbar-fixed sidebar-mini layout-fixed" style="height: auto;">
        @yield('container')
	</body>
    @include('backend.layouts.notif-alert')
    <!-- BEGIN JS-->
    <script src="{{ mix('dist/js/app.js') }}"></script>
    <script src="{{ mix('dist/metronic/js/scripts.bundle.js') }}"></script>
    <script src="{{ mix('dist/js/script.js') }}"></script>
    <script src="{{ mix('dist/js/admin.js') }}"></script>
    <!-- END JS-->
</html>
