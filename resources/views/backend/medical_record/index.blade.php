@extends('backend.layouts.app', ['title' => 'Medical Record', 'menu' => view('backend.medical_record.menu')->render(), 'breadcrumbs' => [
	'Medical Record' => route('admin.medical-records.index')
]])

@section('content')
<div class="content-wrapper" id="medical-records-page">

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
										<span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
											</svg>
										</span>
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
                                                    <label class="form-label fw-bold">Encryption</label>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input cb-active" type="checkbox" value="1" name="active[]"/>
                                                            <span class="form-check-label">Encrypted</span>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input cb-active" type="checkbox" value="0" name="active[]"/>
                                                            <span class="form-check-label">Decrypted</span>
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5 no-footer table-hover" id="medical-records-datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data="id" name="id" width="20px">ID</th>
                                        <th data="label" name="label" orderable="false">Label</th>
                                        <th data="filename" name="filename" orderable="false" searchable="false">File Name</th>
                                        <th data="original_extension" name="original_extension" orderable="false">Extension</th>
                                        <th data="encryption" name="encryption" orderable="false" searchable="false">Encryption</th>
                                        <th data="created_at" name="created_at">Created</th>
                                        <th data="action" name="action" class="wrapper-action" width="1px" orderable="false" searchable="false"></th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold fs-6">Key</label>
                <div class="col-lg-9 fv-row">
                    {{ Form::text('key', null, ['class' => 'form-control', 'id' => 'modal-key']) }}  
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" style="display: none;" id="encrypt">Encrypt</button>
        <button type="button" class="btn btn-sm btn-secondary" style="display: none;" id="download">Download</button>
        <button type="button" class="btn btn-sm btn-primary" style="display: none;" id="decrypt-download">Decrypt & Download</button>
      </div>
    </div>
  </div>
</div>
@endsection
