@php
$title = isset($item) ? "Edit User" : "Create User" ;
@endphp
@extends('backend.layouts.app', ['title' => $title, 'menu' => false, 'breadcrumbs' => [
	'Users' => route('admin.users.index'),
	$title => '',
]])

@section('content')
<div class="content-wrapper" id="user-page">
    <div class="card mb-5 mb-xl-10 mt-5">
        <!-- Card Body -->
        @if(isset($item))
            {{ Form::model($item, ['method' => 'PUT', 'route' => ['admin.users.update', $item->id], 'class'=>'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user']) }}
            {{ Form::hidden('id', $item->id) }}
        @else
            {{ Form::open(['route' => 'admin.users.store', 'class' => 'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user' ]) }}
        @endif

        <div class="card-body">
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label required fw-bold fs-6">Email</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control' . (isset($item) ? ' bg-disabled' : ''), isset($item) ? 'readonly' : '', 'required' ]) }}
                    @error('email')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold required fs-6">Name</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('full_name', null, ['id' => 'full_name', 'class' => 'form-control', 'required']) }}
                    @error('full_name')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div> 
            @if(!isset($item))
            <div class="row mb-6" data-kt-password-meter="true">
                <label class="col-lg-2 col-form-label fw-bold required fs-6">Password</label>
                <div class="col-lg-8 fv-row position-relative">
                    <div class="position-relative password-meter-wrapper">
                        {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                        <div class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n4 d-inline-flex align-items-center visibility-toggle"
                            data-kt-password-meter-control="visibility">
                            <i class="fa fa-eye-slash"></i>

                            <i class="fa fa-eye d-none"></i>
                        </div>
                    </div>
                    <div class="text-muted">
                        Gunakan 8 karakter atau lebih dengan kombinasi huruf besar, huruf kecil dan angka.
                    </div>
                    @error('password')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            @endif
            <div class="row mb-6" style="display: none;">
                <label class="col-lg-2 col-form-label fw-bold required fs-6">Role</label>
                <div class="col-lg-8 fv-row">
                    {{-- {!! $role !!} --}}
                    <select class="form-select hidden" id="role_id" name="role_id" data-control="select2" data-placeholder="Select Role">
                        <option></option>
                        @php $selected = ''; @endphp
                        @foreach($roles as $id => $name)
                        @php
                        if (isset($item) && !empty($item->roles->first())) {
                            $selected = $item->roles->first()->id == $id ? 'selected' : '';
                        }
                        @endphp
                        <!-- <option value="{{ $id }}" {{ old('role_id') == $id ? "selected" : $selected}}>{{ ucwords(str_replace("-"," ",$name)) }}</option> -->
                        <option value="1" selected>super_admin</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <!-- <label class="col-lg-2 col-form-label fw-bold fs-6">Status</label>
                <div class="col-lg-8 fv-row">
                    <div class="form-check form-check-custom form-check-solid" style="padding-top: calc(0.75rem + 1px);"> -->
                        {{ Form::hidden('active', '1', null, ['class' => 'form-check-input', 'id' => 'cb-active']) }}
                        <!-- <label class="form-check-label" for="cb-active">
                            Active
                        </label>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="card-footer py-6 px-9">
            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                Submit
            </button>
            <a href="{{ route('admin.users.index') }}" type="reset" class="btn btn-white btn-light me-2">Cancel</a>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
