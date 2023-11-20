@php
$title = isset($medicalRecord) ? "Edit Medical Record" : "Create Medical Record" ;
@endphp
@extends('backend.layouts.app', ['title' => $title, 'menu' => false, 'breadcrumbs' => [
	'Medical Record' => route('admin.medical-records.index'),
	$title => '',
]])

@section('content')
<div class="content-wrapper" id="articles-page">
    <div class="card mb-5 mb-xl-10 mt-5">
        <!-- Card Body -->
        @if(isset($medicalRecord))
            {{ Form::model($medicalRecord, ['method' => 'PUT', 'route' => ['admin.medical-records.update', $medicalRecord->id], 'id' => 'medical-record-form', 'files' => true, 'class'=>'form-horizontal']) }}
        @else
            {{ Form::open(['route' => 'admin.medical-records.store', 'id' => 'article-form', 'files' => true, 'class'=>'form-horizontal' ]) }}
        @endif

        <div class="card-body">
            @if (isset($medicalRecord))
                {{ Form::hidden('id', $medicalRecord->id) }}
            @endisset
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold required fs-6">File</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::file('medicalrecord', ['class' => 'form-control', 'accept' => '.jpg, .png, .gif, .jpeg', 'required']); }}
                    @error('medicalrecord')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold required fs-6">Key</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('key', null, ['class' => 'form-control', 'required']) }}
                    @error('key')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold fs-6">Label</label>
                <div class="col-lg-8 fv-row">
                    {{ Form::text('label', null, ['class' => 'form-control']) }}
                    @error('label')
                        <strong class="text-danger w-100">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        <div class="card-footer py-6 px-9">
            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                Save
            </button>
            <a href="{{ route('admin.medical-records.index') }}" type="reset" class="btn btn-light me-2">Cancel</a>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
