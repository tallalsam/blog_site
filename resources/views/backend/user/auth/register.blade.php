@extends('backend.user.layout.auth')
@section('content')
<div class="container" style="height: auto;">
    <div class="row align-items-center">
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <form class="form" method="POST" action="{{route('submit.register')}}">
          @csrf
  
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary text-center">
              <h4 class="card-title"><strong>{{ __('Register') }}</strong></h4>
              {{-- <div class="social-line">
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-facebook-square"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-google-plus"></i>
                </a>
              </div> --}}
            </div>
            <div class="card-body ">



              <div class="bmd-form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="first_name" class="form-control" placeholder="{{ __('First Name...') }}" value="{{ old('first_name') }}" >
                </div>
                @if ($errors->has('first_name'))
                  <div id="first_name-error" class="error text-danger pl-3" for="first_name" style="display: block;">
                    <strong>{{ $errors->first('first_name') }}</strong>
                  </div>
                @endif
              </div>


              <div class="bmd-form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="last_name" class="form-control" placeholder="{{ __('Last Name...') }}" value="{{ old('last_name') }}" >
                </div>
                @if ($errors->has('last_name'))
                  <div id="last_name-error" class="error text-danger pl-3" for="last_name" style="display: block;">
                    <strong>{{ $errors->first('last_name') }}</strong>
                  </div>
                @endif
              </div>


              <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="username" class="form-control" placeholder="{{ __('username...') }}" value="{{ old('username') }}" >
                </div>
                @if ($errors->has('username'))
                  <div id="username-error" class="error text-danger pl-3" for="username" style="display: block;">
                    <strong>{{ $errors->first('username') }}</strong>
                  </div>
                @endif
              </div>


              <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">email</i>
                    </span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email') }}" >
                </div>
                @if ($errors->has('email'))
                  <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                    <strong>{{ $errors->first('email') }}</strong>
                  </div>
                @endif
              </div>


              <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" >
                </div>
                @if ($errors->has('password'))
                  <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                    <strong>{{ $errors->first('password') }}</strong>
                  </div>
                @endif
              </div>




              <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password...') }}" >
                </div>
                @if ($errors->has('password_confirmation'))
                  <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </div>
                @endif
              </div>


              <div class="form-check mr-auto ml-3 mt-3">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="policy" name="policy" {{ old('policy', 1) ? 'checked' : '' }} >
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                  {{ __('I agree with the ') }} <a href="#">{{ __('Privacy Policy') }}</a>
                </label>
              </div>
            </div>
            <div class="card-footer justify-content-center">
              <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Create account') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
