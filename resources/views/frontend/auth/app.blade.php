<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('dist/css/admin.css') }}">

    </head>

    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-9 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="{{ mix('dist/js/script.js') }}"></script>
        <script src="{{ mix('dist/js/admin.js') }}"></script>
    </body>
</html>
