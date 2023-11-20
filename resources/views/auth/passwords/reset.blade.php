@extends('auth.layout', ['title' => 'Confirm Reset Password'])

@section('content')
    {{ Form::open(['route' => 'password.update', 'id' => 'kt_sign_in_form', 'novalidate' => "novalidate", 'class'=>'form w-100', 'method' => 'POST' ]) }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Reset Password') }}
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
            <!--end::Link-->
        </div>

        <div class="fv-row mb-10">
            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
            <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" value="{{ $email }}" required readonly/>
            @error('email')
                <strong class="text-danger w-100">{{ $message }}</strong>
            @enderror
        </div>

        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
            </div>
            <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" value="" required autofocus />
            <div class="text-muted">
                {{ __('Use 8 or more characters with a mix of letters, numbers & symbols.') }}
            </div>
            @error('password')
                <strong class="text-danger w-100">{{ $message }}</strong>
            @enderror
        </div>

        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
            </div>
            <input class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation" placeholder="Confirm new password" autocomplete="off" value="" required/>
            @error('password')
                <strong class="text-danger w-100">{{ $message }}</strong>
            @enderror
        </div>
        
        <div class="text-center">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                {{ __('Continue') }}
            </button>
        </div>
    {{ Form::close() }}
@endsection