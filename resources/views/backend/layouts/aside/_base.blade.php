{{--begin::Aside--}}
<div
    id="kt_aside"
    class="aside {{ $darkmode ? 'aside-dark' : 'aside-light' }} aside-hoverable"
    data-kt-drawer="true"
    data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}"
    data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle"
>

    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="{{ route('admin.users.index') }}">
            <img alt="Logo" src="{{ url('/images/laptop-logo.jpg') }}" class="h-40px logo"/>
        </a>

        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                data-kt-toggle="true"
                data-kt-toggle-state="active"
                data-kt-toggle-target="body"
                data-kt-toggle-name="aside-minimize"
        >
            <span class="svg-icon svg-icon-1 rotate-180">
                <i class="fas fa-caret-right"></i>
            </span>
        </div>
    </div>
    {{--end::Brand--}}

    {{--begin::Aside menu--}}
    <div class="aside-menu flex-column-fluid">
        @include('backend.layouts.aside._menu')
    </div>
    {{--end::Aside menu--}}

</div>
{{--end::Aside--}}