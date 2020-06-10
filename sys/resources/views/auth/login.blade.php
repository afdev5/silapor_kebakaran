<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
  <title>SILAPOR &mdash; Kebakaran &rsaquo; Login</title>

  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
 <!-- <img src="{{ asset('assets/img/back.jpg') }}" class="back"> -->
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              {{-- <img src="{{ asset('assets/img/auth.png') }}" height="150px" width="320px"> --}}
              <h3>SILAPOR</h3>
              <h4>Bencana Kebakaran</h4>
            </div>

            <div class="card card-primary">
              <div class="card-header"></div>

              <div class="card-body">
                <form method="post" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>

                     @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="password" class="d-block">Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" tabindex="2" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer text-white">
              Copyright HIMAIF &copy; 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/modules/scroll-up-bar/dist/scroll-up-bar.min.js') }}"></script>
  <script src="{{ asset('assets/js/sa-functions.js') }}"></script>
  
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('assets/js/demo.js') }}"></script>
</body>
</html>