<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    name="viewport">
  @yield('meta')
  <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
  <title>Dashboard &mdash; SPD Kebakaran</title>

  <!-- <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet"
    href="{{ asset('assets/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-lite.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('assets/modules/ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('sys/public/css/app.css') }}">
  <style>
  .customSwalBtn{
		background-color: rgba(214,130,47,1.00);
    border-left-color: rgba(214,130,47,1.00);
    border-right-color: rgba(214,130,47,1.00);
    border: 0;
    border-radius: 3px;
    box-shadow: none;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    font-weight: 500;
    margin: 30px 5px 0px 5px;
    padding: 10px 32px;
	}
  </style>
  <!-- Datatable -->
  <link href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <!-- <link rel="stylesheet" href="{{ asset('assets/magnific-popup/magnific-popup.css') }}"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <style>
    #map {
      height: 100%;
    }
  </style>

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a>
            </li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
              <i class="ion ion-android-person d-lg-none"></i>
              <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
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
          <h5>Sistem Pendeteksi Dini Bencana Kebakaran</h5>
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
            <a href="{{ route('home') }}"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
          </li>

          <li class="menu-header">Menu</li>
          <li>
            <a href="{{ route('user.index') }}"><i class="ion ion-person"></i><span>Users</span></a>
          </li>
          <li>
            <a href="{{ route('laapor.index') }}"><i class="ion ion-stats-bars"></i><span>Laporan Masuk</span></a>
          </li>
          <li>
            <a href="{{ route('laporan.index') }}"><i class="ion ion-stats-bars"></i><span>Rekapan Laporan</span></a>
          </li>
        </ul>
      </aside>
    </div>
    <div class="main-content" id="main">
      <!-- Main -->
      @yield('content')
      <!-- End Main -->
    </div>
    <footer class="main-footer">
      <div class="footer-left">
        Copyright UNIMA &copy; 2020 <div class="bullet"></div> Design By <a href="https://multinity.com/">Multinity</a>
      </div>

    </footer>
  </div>
  </div>

  <!-- <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/scroll-up-bar/dist/scroll-up-bar.min.js') }}"></script>
  <script src="{{ asset('assets/js/sa-functions.js') }}"></script>
  <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/modules/summernote/summernote-lite.js') }}"></script>

  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script> -->
  <script src="{{ asset('sys/public/js/app.js') }}"></script>
  <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
    function modal() {
      $('#modal').modal('toggle');
    }
  </script>
  @yield('js')
  @include('sweet::alert')
</body>

</html>