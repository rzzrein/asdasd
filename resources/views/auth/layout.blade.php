@extends('auth.base', ['title' => $title ?? ''])

@section('container')
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication-->
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">

            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="{{ route('frontend.index') }}" class="mb-12">
                    <img alt="{{ config('app.name') }}" src="{{ url('/images/laptop-logo.svg') }}" class="h-45px"/>
                </a>
                <!--end::Logo-->

                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    @yield('content')
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Authentication-->
    </div>
@endsection
