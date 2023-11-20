@extends('auth.layout', ['title' => 'Confirm Email Address'])

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('resent'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-center mb-10">
        <h1 class="text-dark text-center mb-3">
            {{ __('Verify Your Email Address') }}
        </h1>
    
        <div class="text-gray-400 fw-bold fs-4">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
        </div>
    </div>    

    {{ Form::open(['route' => 'verification.resend', 'id' => 'forgot-password-form', 'class'=>'form w-100', 'novalidate' => 'novalidate', 'method' => 'POST' ]) }}
        @csrf
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                {{ __('Click here to request another') }}
            </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('logout') }}" class="logout link-primary fs-6 fw-bolder mt-4">Sign out from {{auth()->user()->email ?? null}}</a>
                @endif
        </div>
    {{ Form::close() }}
@endsection
