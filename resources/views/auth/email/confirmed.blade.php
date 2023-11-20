@extends('auth.app')

@section('content')
<section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center text-center">
                    <div class="p-1"><img class="img-fluid" src="{{ url('/dist/images/sslogo.png') }}" alt="branding logo"></div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Success</span></h6>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block text-center">
                    Your email change (from {{ $oldEmail }} to {{ $newEmail }}) has been confirmed. Please (re)login using your new email address.
                </div>
            </div>
            <div class="card-footer">
                <div class="">
                    <p class="float-right text-xs-center m-0"><a href="{{ url('') }}" class="card-link">Back To Homepage</a></p>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection
