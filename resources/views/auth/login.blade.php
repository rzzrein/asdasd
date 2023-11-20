@extends('auth.layout', ['title' => 'Sign In'])

@section('content')
    {{ Form::open(['route' => 'login', 'id' => 'kt_sign_in_form', 'novalidate' => "novalidate", 'class'=>'form w-100', 'method' => 'POST' ]) }}
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">
                Sign In to {{ config('app.name') }}
            </h1>

            {{-- <div class="text-gray-400 fw-bold fs-4">
                {{ __('New Here?') }}

                <a href="{{ route('register') }}" class="link-primary fw-bolder">
                    {{ __('Create an Account') }}
                </a>
            </div> --}}
        </div>

        <div class="fv-row mb-10">
            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
            <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" value="{{ old('email') }}" required autofocus/>
            @error('email')
                <strong class="text-danger w-100">{{ $message }}</strong>
            @enderror
        </div>

        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">
                        {{ __('Forgot Password ?') }}
                    </a>
                @endif
            </div>
            <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" value="" required/>
            @error('password')
                <strong class="text-danger w-100">{{ $message }}</strong>
            @enderror
        </div>

        <div class="fv-row mb-10">
            <label class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="remember"/>
                <span class="form-check-label fw-bold text-gray-700 fs-6">{{ __('Remember me') }}
            </span>
            </label>
        </div>

        <div class="text-center">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                {{ __('Continue') }}
            </button>

            {{-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
                <a href="{{ url('/auth/redirect/google') }}?redirect_uri={{ url()->previous() }}" class="btn btn-flex flex-center btn-light-danger btn-lg w-100 mb-5">
                    <i class="fab fa-google mr-2"></i>                    {{ __('Continue with Google') }}
                </a>
                <a href="{{ url('/auth/redirect/facebook') }}?redirect_uri={{ url()->previous() }}" class="btn btn-flex flex-center btn-light-primary btn-lg w-100 mb-5">
                    <i class="fab fa-facebook mr-2"></i>
                    {{ __('Continue with Facebook') }}
                </a>
            </div> --}}
        </div>
    {{ Form::close() }}
@endsection