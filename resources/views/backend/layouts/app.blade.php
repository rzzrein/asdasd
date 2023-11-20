@extends('backend.layouts.base')

@section('container')
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        @include('backend.layouts.aside._base')

        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('backend.layouts.header._base')

            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                @include('backend.layouts.toolbars._toolbar-1', ['title' => $title ?? '', 'menu' => $menu ?? '', 'breadcrumbs' => $breadcrumbs ?? []])

                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="{{ $narrowmode ? 'container-xxl' : 'container-fluid my-5'}}">
                        @yield('content')
                    </div>
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->

            @include('backend.layouts.footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->

<!--begin::Drawers-->
@include('backend.layouts.partials.topbar._activity-drawer')
@include('backend.layouts.partials.topbar._messenger')
<!--end::Drawers-->

@endsection
