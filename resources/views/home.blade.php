@extends('layouts.app')

@section('content')
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
                    1,201
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
                    47
                  </div>
                </div>
              </div>
            </div>                  
          </div>
        </section>
@endsection
