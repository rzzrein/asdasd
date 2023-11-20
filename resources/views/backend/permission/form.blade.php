@php
$title = isset($item) ? "Edit Permission" : "Create Permission" ;
@endphp
@extends('backend.layouts.app', ['title' => $title, 'menu' => false, 'breadcrumbs' => [
	'Permission' => route('admin.permissions.index'),
	$title => '',
]])

@section('content')
<div class="content-wrapper" id="permission-page">
    <div class="card mb-5 mb-xl-10 mt-5">
        <!-- Card Body -->
        @if(isset($item))
            {{ Form::model($item, ['method' => 'PUT', 'route' => ['admin.permissions.update', $item->id], 'class'=>'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user']) }}
            {{ Form::hidden('id', $item->id) }}
            {{ csrf_field() }}
            {{ method_field('PUT') }}
        @else
            {{ Form::open(['route' => 'admin.permissions.store', 'class' => 'form fv-plugins-bootstrap5 fv-plugins-framework', 'id' => 'form-user' ]) }}
        @endif

        <div class="card-body">
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold required fs-6">Name</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    @error('name')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-bold fs-6">Display Name</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('display_name', null, ['class' => 'form-control']) }}
                    @error('display_name')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-bold fs-6">Description</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('description', null, ['class' => 'form-control']) }}
                    @error('description')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer py-6 px-9">
            {{ Form::hidden('id', null) }}
            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                Submit
            </button>
            <a href="{{ route('admin.permissions.index') }}" type="reset" class="btn btn-light me-2">Cancel</a>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
