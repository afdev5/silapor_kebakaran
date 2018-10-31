<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
  <!-- <iframe src="https://cross-origin.com/myvideo.html" allow="autoplay"> -->
  <title>Dashboard &mdash; Tombol Padam</title>

  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-lite.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
	integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>

	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
	integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin="">
	</script>
  <!-- Datatable -->
  <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/magnific-popup/magnific-popup.css') }}">

  <!-- <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' /> -->
  <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
    </style>

</head>

<body>
  <!-- <audio loop muted autoplay id="alarm" src="{{ asset('assets/alarm.mp3') }}"></audio> -->
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="ion ion-ios-bell-outline"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">View All</a>
                </div>
              </div>
              <div class="dropdown-list-content">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.jpeg') }}" class="rounded-circle dropdown-item-img">
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <img alt="image" src="{{ asset('assets/img/avatar/avatar-2.jpeg') }}" class="rounded-circle dropdown-item-img">
                  <div class="dropdown-item-desc">
                    <b>Ujang Maman</b> has moved task <b>Fix bug footer</b> to <b>Progress</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
            <i class="ion ion-android-person d-lg-none"></i>
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="#" class="dropdown-item has-icon">
                <i class="ion ion-android-person"></i> Profile
              </a>
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @else
              <a href="{{ route('logout') }}" class="dropdown-item has-icon" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="ion ion-log-out"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              @endguest
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <img src="{{ asset('assets/img/auth.png') }}" height="70px" width="145px">
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.jpeg') }}">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name">{{ Auth::user()->name }}</div>
              <div class="user-role">
                @if(Auth::user()->role == '0')
                  Administrator
                @else
                  Users
                @endif
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
              <a href="#"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Menu</li>
            <li>
              <a href="{{ route('user.index') }}"><i class="ion ion-person"></i><span>Users</span></a>
            </li>
            <li>
              <a href="{{ route('maps') }}"><i class="ion ion-ios-location-outline"></i><span>Maps</span></a>
            </li>
            <li>
              <a href="{{ route('laapor.index') }}"><i class="ion ion-stats-bars"></i><span>Lapor</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <div class="main-content">
        <!-- Main -->
        @yield('content')
        <!-- End Main -->
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright HIMAIF &copy; 2018 <div class="bullet"></div> Design By <a href="https://multinity.com/">Multinity</a>
        </div>
        
      </footer>
    </div>
  </div>

  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/scroll-up-bar/dist/scroll-up-bar.min.js') }}"></script>
  <script src="{{ asset('assets/js/sa-functions.js') }}"></script>
  <!-- <script src="{{ asset('assets/magnific-popup/jquery.magnific-popup.js') }}"></script> -->
  <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/modules/summernote/summernote-lite.js') }}"></script>

  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <!-- <script src="../dist/js/demo.js"></script> -->
  <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    var alarm = new Audio("{{ asset('assets/alarm.mp3') }}");
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: "6324c7277b283f63b2e1",
        cluster: "ap1",
        // Sebaiknya encrypted dan disableStats dijadikan false bila diakses dari localhost atau public ip
        encrypted: true,
        disableStats: true
      });

      @if (Auth::check())
        var channel = 'lapor-channel.{{ Auth::user()->id }}';
        Echo.channel(channel).listen('LaporEvent', function(e) {
          alarm.play()
          // alert(e.message);
          // var r = confirm("Pe!");
          // if (r == true) {
          //     txt = "You pressed OK!";
          // } else {
          //     txt = "You pressed Cancel!";
          // }
          // window.open("{{ route('laapor.index') }}")
        });
      @else
        var channel = 'lapor-channel';
        Echo.channel(channel).listen('LaporEvent', function(e) {
          alert(e.message);
        });
      @endif
  </script>
  <script type="text/javascript">
          function modal(){
            $('#modal').modal('toggle');
          }
  </script>
  @yield('js')

    <!-- <script>
      window.onload = function(){
        function initMap() {
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -6.273300, lng: 106.823925},
          scrollwheel: false,
          zoom: 3
        });
      }
    }
 
</script> -->
<!-- 
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBR_bmivnGX2unbpwnMp1xi_VsZK7pspiw&callback=initMap" type="script"></script> -->
</body>
</html>