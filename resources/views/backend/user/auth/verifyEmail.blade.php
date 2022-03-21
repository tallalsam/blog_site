@extends('backend.user.layout.auth')
@section('content')
<div class="container" style="height: auto;">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8">
            <div class="card card-login card-hidden mb-3">
              <div class="card-header card-header-primary text-center">
                <p class="card-title"><strong>{{ __('Verify Your Email Address') }}</strong></p>
              </div>
              <div class="card-body">
                <p class="card-description text-center"></p>
                <p>
                  @if (session('resent'))
                      <div class="alert alert-success" role="alert">
                          {{ __('A fresh verification link has been sent to your email address.') }}
                      </div>
                  @endif
                  
                  {{ __('Before proceeding, please check your email for a verification link.') }}
                  
                  @if (Route::has('verification.request'))
                      {{ __('If you did not receive the email') }},  
                      <form class="d-inline" method="POST" action="{{ route('verification.request') }}">
                          @csrf
                          <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                      </form>
                  @endif
                </p>
              </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>
    </div>
  </div>
@endsection
