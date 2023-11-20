@php
$title = isset($user) ? "Edit Profile" : "Create Profile" ;
@endphp
@extends('backend.layouts.app', ['title' => $title, 'menu' => false, 'breadcrumbs' => [
	$title => route('admin.profile.index'),
	$title => '',
]])

@section('content')
<div class="content-wrapper" id="profile-page">
    <div class="card mb-5 mb-xl-10 mt-5">
        <!-- Card Body -->
        @if(isset($user))
            {{ Form::model($user, ['method' => 'PUT', 'route' => ['admin.profile.update', $user->id], 'class'=>'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user']) }}
            {{ Form::hidden('id', $user->id) }}
        @else
            {{ Form::open(['route' => 'admin.roles.store', 'class' => 'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user' ]) }}
        @endif

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-bold required fs-6">Name</label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::text('full_name', null, ['class' => 'form-control']) }}
                            @error('full_name')
                                <strong class="text-danger w-100">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-bold required fs-6">Username</label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::text('username', null, ['class' => 'form-control validate[required]']) }}
                            @error('username')
                                <strong class="text-danger w-100">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-bold required fs-6">Email</label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::text('email', null, ['class' => 'form-control validate[required, custom[email]]']) }}
                            @error('email')
                                <strong class="text-danger w-100">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <p class="form-text text-muted alert alert-warning">Please leave field bellow if you do not want change the password.</p>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-bold required fs-6">Old Password</label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::password('old_password', ['class' => 'form-control']) }}
                            @error('old_password')
                                <strong class="text-danger w-100">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-bold required fs-6">New Password</label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::password('password', ['class' => 'form-control']) }}
                            @error('password')
                                <strong class="text-danger w-100">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-bold required fs-6">New Password Confimation</label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                            @error('password')
                                <strong class="text-danger w-100">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col">

                </div>

            </div>
        </div>
        <div class="card-footer d-flex justify-content-start py-6 px-9">
            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                Submit
            </button>
            <button type="reset" class="btn btn-white btn-active-light-primary me-2">Discard</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
