@extends('backend.user.layout.auth')
@section('content')

<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
      <!-- <h3>Log in to see how you can speed up your web development with out of the box CRUD for #User Management and more.</h3> -->
    </div>
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form id="loginform" class="form " method="POST" action="">
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>Login</strong></h4>
            <div class="social-line">
            </div>
          </div>
          <div class="card-body">
            <!-- <p class="card-description text-center"> <strong>admin@material.com</strong> <strong>secret</strong> </p> -->
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="" required>
              </div>
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" value="" required>
              </div>
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Lets Go') }}</button>
          </div>
        </div>
      </form>

      @include('backend.user.partials.errors');
      
    </div>
  </div>
</div>


<script>

  $("#loginform").submit(function(e) {
    //prevent Default functionality
    e.preventDefault();

    //get the action-url of the form
    var actionurl = '{{route($type)}}';
    //do your own request an handle the results
    $.ajax({
      url: actionurl,
      type: 'post',
      data: $("#loginform").serialize(),
      success: function(data) {
        if(data.error != ''){
          toastr.error(data.error);
        }
        else
        {
          document.cookie = "access_token="+data.token;

          $.ajax({
            url: 'set_session',
            type: 'post',
            data: {_token: "{{ csrf_token() }}",role:data.role, user:data.success},
            success: function(response) {
              window.location.href = data.role+'-dashboard-page';
            }
          });
        }
      }
    });
  });

</script>

@endsection


