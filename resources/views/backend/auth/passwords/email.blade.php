<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Personal Blog - Reset Email</title>

    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('adminPanel/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminPanel/css/sb-admin.css') }}" rel="stylesheet">
    <style>
        .sytle-bac {
            background-color: #00e676;
        }

        .btn-primary {
            color: #fff;
            background-color: #42a5f5;
            border-color: #42a5f5;
        }
        .hstyle {
          margin-top: 5%;
          text-align: center;
          font-family: 'Times New Roman', Times, serif;
          font-size: 30px;
          color: #ffffff;
        }
        .h6style {
          text-align: center;
          font-family: 'Times New Roman', Times, serif;
          font-size: 20px;
          color: #ffffff;
        }
    </style>
  </head>

  <body class="sytle-bac">    

    <div class="container">
      <h4 class="hstyle">Personal Blog</h4>
      <h6 class="h6style">User Reset Email</h6>
      <div class="card card-login mx-auto mt-5">
        <div class="card-body" style="margin-top:3%;">
          <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> {{ __('Send Password Reset Link') }}
            </button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="{{ route('login') }}">Login an Account</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('adminPanel/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminPanel/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('adminPanel/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  </body>

</html>


