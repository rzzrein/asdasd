<div class="d-flex align-items-stretch flex-shrink-0">
	<!--begin::User menu-->
	<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
		<!--begin::Menu wrapper-->
		<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            @if (!empty(auth()->user()->avatar_url))
                <img alt="Logo" src="{{ auth()->user()->avatar_url }}">
            @else
                <i class="far fa-user"></i>
            @endif
		</div>
		<!--begin::Menu-->
		<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
			<!--begin::Menu item-->
			<div class="menu-item px-3">
				<div class="menu-content d-flex align-items-center px-3">
					<!--begin::Avatar-->
					<div class="symbol symbol-50px me-5">
                        @if (!empty(auth()->user()->avatar_url))
    						<img alt="Logo" src="{{ auth()->user()->avatar_url }}">
                        @endif
					</div>
					<!--end::Avatar-->
					<!--begin::Username-->
					<div class="d-flex flex-column">
						<div class="fw-bolder d-flex align-items-center fs-5"> {{ auth()->user()->full_name }}
						</div>
						<a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
					</div>
					<!--end::Username-->
				</div>
			</div>
			<!--end::Menu item-->
			<!--begin::Menu separator-->
			<div class="separator my-2"></div>
			<!--end::Menu separator-->
			<!--begin::Menu item-->
			<div class="menu-item px-5 my-1">
				<a href="{{ route('logout') }}" class="menu-link px-5 logout"> 
					<span class="menu-icon"><span class="svg-icon svg-icon-2"><i class="fa fa-sign-out"></i></span></span>
					Sign Out 
				</a>
			</div>			

            {{-- 
			<div class="menu-item px-5">
				<a href="#" data-action="http://localhost:8001/logout" data-method="post" data-csrf="hgQNANbOmkzExlyDc7trdfZd0EYawsnqTiKZHFWc" data-reload="true" class="button-ajax menu-link px-5"> Sign Out </a>
			</div>

			<div class="menu-item px-5">
				<a href="#" class="menu-link px-5" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Coming soon">
					<span class="menu-text">My Projects</span>
					<span class="menu-badge">
						<span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
					</span>
				</a>
			</div>
			<div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
				<a href="#" class="menu-link px-5">
					<span class="menu-title">My Subscription</span>
					<span class="menu-arrow"></span>
				</a>
				<!--begin::Menu sub-->
				<div class="menu-sub menu-sub-dropdown w-175px py-4">
					<!--begin::Menu item-->
					<div class="menu-item px-3">
						<a href="#" class="menu-link px-5"> Referrals </a>
					</div>
					<!--end::Menu item-->
					<!--begin::Menu item-->
					<div class="menu-item px-3">
						<a href="#" class="menu-link px-5"> Billing </a>
					</div>
					<!--end::Menu item-->
					<!--begin::Menu item-->
					<div class="menu-item px-3">
						<a href="#" class="menu-link px-5"> Payments </a>
					</div>
					<!--end::Menu item-->
					<!--begin::Menu item-->
					<div class="menu-item px-3">
						<a href="#" class="menu-link d-flex flex-stack px-5"> Statements <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="View your statements" aria-label="View your statements"></i>
						</a>
					</div>
					<!--end::Menu item-->
					<!--begin::Menu separator-->
					<div class="separator my-2"></div>
					<!--end::Menu separator-->
					<!--begin::Menu item-->
					<div class="menu-item px-3">
						<div class="menu-content px-3">
							<label class="form-check form-switch form-check-custom form-check-solid">
								<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications">
								<span class="form-check-label text-muted fs-7"> Notifications </span>
							</label>
						</div>
					</div>
					<!--end::Menu item-->
				</div>
				<!--end::Menu sub-->
			</div>
			<div class="menu-item px-5" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Coming soon">
				<a href="#" class="menu-link px-5"> My Statements </a>
			</div> --}}
			<!--end::Menu item-->

			<!--end::Menu item-->
		</div>
		<!--end::Menu-->
		<!--end::Menu wrapper-->
	</div>
	<!--end::User menu-->
	<!--begin::Header menu toggle-->
	<div class="d-flex align-items-center d-lg-none ms-2 me-n3" data-bs-toggle="tooltip" title="" data-bs-original-title="Show header menu">
		<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
			<!--begin::Svg Icon | path: assets/media/icons/duotune/text/txt001.svg-->
			<span class="svg-icon svg-icon-1">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="currentColor"></path>
					<path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="currentColor"></path>
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
	</div>
	<!--end::Header menu toggle-->
</div>