@extends('backend.layouts.app', ['title' => 'Roles', 'menu' => view('backend.role.menu')->render(), 'breadcrumbs' => [
	'Roles' => route('admin.roles.index')
]])

@section('content')
<div class="content-wrapper" id="role-page">

	<div class="content">
        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-6 pl-1">
								</div>
                                <div class="col-sm-2 pl-1">
                                    <a href="#" class="btn btn-flex btn-light btn-active-primary fw-bolder float-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
										<i class="fa fa-filter"></i>
										Filter
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_624475c555b7c">
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>
                                        <div class="separator border-gray-200"></div>
                                        <div class="px-7 py-5">
                                            <form action="" method="post" id="table-filter">
                                                <div class="mb-10">
                                                    <label class="form-label fw-bold">Status</label>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input cb-active" type="checkbox" value="1" name="active[]"/>
                                                            <span class="form-check-label">Active</span>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input cb-active" type="checkbox" value="0" name="active[]"/>
                                                            <span class="form-check-label">Inactive</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-10">
                                                    <label class="form-label fw-bold">Created Date</label>
                                                    <div class="d-flex">
                                                        <input type="text" class="form-control form-datepicker" placeholder="All Time">
                                                        <input type="hidden" name="start_date" id="form-startdate" value="" class="form-daterangepicker">
                                                        <input type="hidden" name="end_date" id="form-enddate" value="" class="form-daterangepicker">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2 btn-reset" data-kt-menu-dismiss="true">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
								</div>
								<div class="col-sm-4 pr-1">
									<div class="input-group input-group mb-1">
										<input type="text" class="form-control" id="filter-keyword">
										<div class="input-group-append">
											<button class="btn btn-secondary" id="btn-filter" type="button"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="table-responsive p-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 no-footer table-hover" id="role-datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data="id" name="id" width="20px">ID</th>
                                        <th data="name" name="name">Name</th>
                                        <th data="active" name="active">Status</th>
                                        {{-- <th data="display_name" name="display_name" >Display Name</th> --}}
                                        <th data="description" name="description" >Desc</th>
                                        <th data="created_at" name="created_at" width="200px">Created</th>
                                        <th data="action" name="action" searchable="false" orderable="false" class="no-sort text-right wrapper-action" width="1px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
