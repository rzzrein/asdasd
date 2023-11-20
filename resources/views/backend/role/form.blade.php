@php
$title = isset($role) ? "Edit Role" : "Create Role" ;
@endphp
@extends('backend.layouts.app', ['title' => $title, 'menu' => false, 'breadcrumbs' => [
	'Roles' => route('admin.roles.index'),
	$title => '',
]])

@section('content')
<div class="content-wrapper" id="role-page">
    <div class="card mb-5 mb-xl-10 mt-5">
        <!-- Card Body -->
        @if(isset($role))
            {{ Form::model($role, ['method' => 'PUT', 'route' => ['admin.roles.update', $role->id], 'class'=>'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user']) }}
            {{ Form::hidden('id', $role->id) }}
        @else
            {{ Form::open(['route' => 'admin.roles.store', 'class' => 'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user' ]) }}
        @endif

        <div class="card-body">
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold required fs-6">Name</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    @error('name')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            {{-- <div class="row mb-6">
                <label class="col-lg-2 col-form-label required fw-bold fs-6">Display Name</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('display_name', null, ['class' => 'form-control']) }}
                    @error('display_name')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div> --}}
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold fs-6">Status</label>
                <div class="col-lg-8 fv-row">
                    <div class="form-check form-check-custom form-check-solid" style="padding-top: calc(0.75rem + 1px);">
                        {{ Form::checkbox('active', '1', null, ['class' => 'form-check-input', 'id' => 'cb-active']) }}
                        <label class="form-check-label" for="cb-active">
                            Active
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold fs-6">Description</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('description', null, ['class' => 'form-control']) }}
                    @error('description')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold fs-6">Permission</label>
                <div class="col-lg-6 fv-row">
                    {{ Form::select('permission_id[]', $permissions, null, ['multiple' => true, 'style' => 'width:100%', 'id' => 'select-permission']) }}
                    @error('permission_id')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="col-lg-2">
                    <div class="form-check form-check-custom form-check-solid" style="padding-top: calc(0.75rem + 1px);">
                        {{ Form::checkbox('select_all', '1', null, ['class' => 'form-check-input', 'id' => 'cb-select-all']) }}
                        <label class="form-check-label" for="cb-select-all">
                            Select All
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer py-6 px-9">
            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                Submit
            </button>
            <a href="{{ route('admin.roles.index') }}" type="reset" class="btn btn-light me-2">Cancel</a>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
