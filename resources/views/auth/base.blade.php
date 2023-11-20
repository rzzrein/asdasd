<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ isset($title) ? $title.' | ' : '' }}{{ config('app.name') }}</title>
        @if ($darkmode)
		<link rel="stylesheet" href="{{ mix('dist/metronic/css/style.dark.bundle.css') }}">
        @else
		<link rel="stylesheet" href="{{ mix('dist/metronic/css/style.bundle.css') }}">
        @endif
		<link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">	
		<link rel="shortcut icon" href="{{ url('/images/favicon.ico') }}"/>
	</head>
	<body class="login-page" style="min-height: 466px;">
        @yield('container')
	</body>

    <script src="{{ mix('dist/js/app.js') }}"></script>
    <script src="{{ mix('dist/js/admin.js') }}"></script>
    <script src="{{ mix('dist/js/script.js') }}"></script>
</html>