@extends('auth.layout', ['title' => 'Sign Up'])

@section('content')
{{ Form::open(['route' => 'register', 'id' => 'login-form', 'class'=>'form w-100', 'method' => 'POST' ]) }}
    <div class="text-center mb-10">
        <h1 class="text-dark mb-3">
            {{ __('Create an Account') }}
        </h1>

        <div class="text-gray-400 fw-bold fs-4">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="link-primary fw-bolder">
                {{ __('Sign in here') }}
            </a>
        </div>
    </div>

    <a href="{{ url('/auth/redirect/google') }}?redirect_uri={{ url()->previous() }}" class="btn btn-light-danger fw-bolder w-100 mb-10">
        <i class="fab fa-google mr-2"></i>
        {{ __('Sign up with Google') }}
    </a>

    <div class="d-flex align-items-center mb-10">
        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
        <span class="fw-bold text-gray-400 fs-7 mx-2">{{ __('OR') }}</span>
        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
    </div>

    <div class="row fv-row mb-7">
        <div class="col-xl-6">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('First Name') }}</label>
            <input class="form-control form-control-lg form-control-solid" type="text" name="first_name" autocomplete="off" value="{{ old('first_name') }}"/>
            @error('first_name')
                <div class="text-danger w-100">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-xl-6">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('Last Name') }}</label>
            <input class="form-control form-control-lg form-control-solid" type="text" name="last_name" autocomplete="off" value="{{ old('last_name') }}"/>
            @error('last_name')
                <div class="text-danger w-100">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="fv-row mb-7">
        <label class="form-label fw-bolder text-dark fs-6">{{ __('Email') }}</label>
        <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" value="{{ old('email') }}"/>
        @error('email')
            <div class="text-danger w-100">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-10 fv-row" data-kt-password-meter="true">
        <div class="mb-1">
            <label class="form-label fw-bolder text-dark fs-6">
                {{ __('Password') }}
            </label>

            <div class="position-relative mb-3">
                <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="new-password"/>
                @error('password')
                    <div class="text-danger w-100">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="text-muted">
            {{ __('Use 8 or more characters with a mix of letters, numbers & symbols.') }}
        </div>
    </div>

    <div class="fv-row mb-5">
        <label class="form-label fw-bolder text-dark fs-6">{{ __('Confirm Password') }}</label>
        <input class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation" autocomplete="off"/>
        @error('password')
            <div class="text-danger w-100">{{ $message }}</div>
        @enderror
    </div>

    <div class="fv-row mb-10">
        <label class="form-check form-check-custom form-check-solid form-check-inline">
            <input class="form-check-input" type="checkbox" name="toc" value="1"/>
            <span class="form-check-label fw-bold text-gray-700 fs-6">
                {{ __('I Agree &') }} <a href="#" target="_blank" class="ms-1 link-primary">{{ __('Terms and conditions') }}</a>.
            </span>
        </label>
        @error('toc')
            <div class="text-danger w-100 mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-center">
        <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
            Submit
        </button>
    </div>
    <!--end::Actions-->
{{ Form::close() }}
@endsection
