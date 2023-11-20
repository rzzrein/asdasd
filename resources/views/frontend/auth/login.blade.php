@extends('auth.app', ['title' => 'Login Member'])

@section('content')
<section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center text-center">
                    <div class="p-1"><img class="img-fluid" src="{{ url('/dist/images/sslogo.png') }}" alt="branding logo"></div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Member Area</span></h6>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block">
                    {{ Form::open(['route' => 'user.signin.post', 'id' => 'login-form', 'class'=>'form-horizontal  form-simple', 'method' => 'POST' ]) }}
                        <fieldset class="form-group position-relative has-icon-left mb-2">
                            <input type="text" class="form-control input form-control-lg input-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email or Username" required autofocus>
                            <div class="form-control-position">
                                <i class="fa fa-user"></i>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left mb-2">
                            <input type="password" class="form-control input form-control-lg input-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                            <div class="form-control-position">
                                <i class="fa fa-key"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-footer">
                <div class="">
                    @if (Route::has('password.request'))
                        <p class="float-left text-xs-center m-0"><a href="{{ route('password.request') }}" class="card-link">{{ __('Forgot Your Password?') }}</a></p>
                    @endif
                    <p class="float-right text-xs-center m-0"><a href="{{ url('') }}" class="card-link">Back To Homepage</a></p>
                </div>
            </div>
        </div>
    </div>
</section>    

    <!-- Nested Row within Card Body -->
@endsection
