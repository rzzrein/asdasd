@extends('backend.layouts.app', ['title' => 'Permissions', 'menu' => view('backend.permission.menu')->render(), 'breadcrumbs' => [
	'Permissions' => route('admin.permissions.index')
]])

@section('content')
<div class="content-wrapper" id="permission-page">
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
								<div class="col-sm-6 pr-1">
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5 no-footer table-hover" id="permission-datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data="id" name="id" width="20px">ID</th>
                                        <th data="name" name="name">Permission</th>
                                        <th data="display_name" name="display_name">Display Name</th>
                                        <th data="description" name="description">Desc</th>
                                        <th data="created_at" name="created_at" width="150px">Created</th>
                                        <th data="action" name="action" searchable="false" orderable="false" class="no-sort text-right wrapper-action" width="1px"></th>
                                    </tr>
                                </thead>
                                <tbody class="{{$darkmode ? 'bg-black' : 'bg-white' }}">
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
