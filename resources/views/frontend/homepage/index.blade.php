@extends('frontend.layout.app', ['title' => config('app.name')])

@section('content')
    @if (trim($readme)!='')
        {{ $readme }}
    @else
        <div class="card-deck mb-3 text-center">
            <div class="card mb-3 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Documentation</a></h4>
                </div>
                <div class="card-body">
                    Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.                
                </div>
            </div>
            <div class="card mb-3 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Laracasts</a></h4>
                </div>
                <div class="card-body">
                    Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                </div>
            </div>
            <div class="card mb-3 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Laravel News</a></h4>
                </div>
                <div class="card-body">
                Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                </div>
            </div>
            <div class="card mb-3 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Vibrant Ecosystem</h4>
                </div>
                <div class="card-body">
                    Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon" class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="underline">Telescope</a>, and more.
                </div>
            </div>
        </div>
    @endif
@endsection
