<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class=" container-fluid  d-flex flex-stack">
		<!--begin::Page title-->
		<div class="d-flex align-items-center me-3">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3"> {{ $title }} </h1>
			<!--end::Title-->
			<span class="h-20px border-gray-200 border-start mx-4"></span>

			<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
				<!--begin::Item-->
				<li class="breadcrumb-item text-muted">
					<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary"> Home </a>
				</li>
				@if (!empty($breadcrumbs))
					@forelse ($breadcrumbs as $title => $url)
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-200 w-5px h-2px"></span>
						</li>
						<li class="breadcrumb-item text-muted"> <a class="text-decoration-none" href="{{ $url }}">{{ $title }}</a> </li>
					@empty
					@endforelse
				@endif
			</ul>
	
		</div>

		<!--end::Page title-->
		<!--begin::Actions-->
		<div class="d-flex align-items-center py-1">
			{!! $menu !!}
		</div>
		<!--end::Actions-->
	</div>
	<!--end::Container-->
</div>