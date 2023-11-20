@extends('auth.layout', ['title' => 'Reset Password'])

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>            
        </div>
    @endif
    {{ Form::open(['route' => 'password.email', 'id' => 'forgot-password-form', 'class'=>'form w-100', 'novalidate' => 'novalidate', 'method' => 'POST' ]) }}
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">
                {{ __('Forgot Password ?') }}
            </h1>

            <div class="text-gray-400 fw-bold fs-4">
                {{ __('Enter your email to reset your password.') }}
            </div>
        </div>

        <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-gray-900 fs-6">{{ __('Email') }}</label>
            <input class="form-control form-control-solid" type="email" name="email" autocomplete="off" value="{{ old('email') }}" required autofocus/>
            @error('email')
                <div class="text-danger w-100">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                Submit
            </button>

            <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">{{ __('Cancel') }}</a>
        </div>
    {{ Form::close() }}
@endsection
