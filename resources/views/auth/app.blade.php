<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ url('/images/favicon.ico') }}">

        <title>{{ isset($title) ? $title.' | ' : '' }} {{ config('app.name', 'Laravel') }}</title>
		<link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
    </head>

    <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
        <!-- ////////////////////////////////////////////////////////////////////////////-->
        <div class="app-content content container-fluid">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- ////////////////////////////////////////////////////////////////////////////-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="{{ mix('dist/js/admin.js') }}"></script>        
    </body>    


</html>
