@extends('frontend.base', ['title' => $title ?? ''])

@section('container')
    <div class="d-flex flex-column flex-root">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand {{ $darkmode ? 'text-white' : '' }}" href="#"><i class="far fa-kiss-wink-heart"></i>&nbsp;{{ config('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link  {{ $darkmode ? 'text-white' : '' }} active" aria-current="page" href="{{ url('') }}">Home</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                @if (auth()->user()->hasRole(['developer', 'admin']))
                                <li class="nav-item">
                                    <a class="nav-link {{ $darkmode ? 'text-white' : '' }}" href="{{ url('/admin/dashboard') }}">Back To Admin Dashboard</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link {{ $darkmode ? 'text-white' : '' }} logout" href="{{ route('logout') }}">Sign Out</a>
                                </li>    
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ $darkmode ? 'text-white' : '' }}" href="{{ route('login') }}">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $darkmode ? 'text-white' : '' }}" href="{{ route('register') }}">Sign Up</a>
                                </li>
                            @endif
                        @endif                    
                    </ul>
                </div>
            </div>
        </nav>        
        <!--begin::Authentication-->
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">

            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="{{ route('frontend.index') }}" class="mb-12">
                    <img alt="{{ config('app.name') }}" src="{{ url('/dist/images/sslogo.png') }}" class="h-45px"/>
                </a>
                <!--end::Logo-->

                <!--begin::Wrapper-->
                <div class="bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    @yield('content')
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication-->
    </div>
@endsection
