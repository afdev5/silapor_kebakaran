@extends('layouts.app')

@section('content')
@php
$lapor = App\Lapor::where('status', '1')->count();
$user = App\User::where('role', '1')->count();
@endphp
        <section class="section">
          <h1 class="section-header">
            <div>Dashboard</div>
          </h1>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-warning">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Laporan Kebakaran</h4>
                  </div>
                  <div class="card-body">
                    {{ $lapor }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card card-sm-3">
                <div class="card-icon bg-success">
                  <i class="ion ion-person"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Users</h4>
                  </div>
                  <div class="card-body">
                    {{ $user }}
                  </div>
                </div>
              </div>
            </div>                  
          </div>
        </section>
@endsection

@section('js')
<script type="text/javascript">
    var alarm = new Audio("{{ asset('assets/alarm.mp3') }}");
    alarm.currentTime = 10;
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
          // $("#main").load("{{ route('laapor.index') }}" + " #main");
          alarm.play()
          // alert(e.message);
          // var r = confirm("Pe!");
          // if (r == true) {
          //     txt = "You pressed OK!";
          // } else {
          //     txt = "You pressed Cancel!";
          // }
          window.open("{{ route('laapor.index') }}", '_blank')
          setTimeout(function(){
            alarm.volume = 0
          }, 5000); 
        });
      @else
        var channel = 'lapor-channel';
        Echo.channel(channel).listen('LaporEvent', function(e) {
          alert(e.message);
        });
      @endif
  </script>
@endsection
