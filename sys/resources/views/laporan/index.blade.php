@extends('layouts.app')

@section('meta')
<meta name="csrf-token" content="{{ Session::token() }}">
@endsection

@section('content')
<section class="section">
  <h1 class="section-header">
    <div>Rekapan Laporan</div>
  </h1>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <!-- <a href="{{ route('laporan.create') }}" class="pull-right btn btn-success btn-xs">Maps</a> -->
          <div class="float-right">
            <input type="text" name="daterange" class="form-control" value="01/01/2020 - 01/15/2020">
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Status</th>
                  <th>Nama</th>
                  <th>No Hp</th>
                  <th>Tanggal</th>
                  <th style="width: 100px">Gambar</th>
                  <th style="width: 100px">#</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      $('#table').DataTable().destroy();
      load_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });
    load_data();
    function load_data(from_date = '', to_date = '') {
      $('#table').DataTable({
        processing: true,
        serverSide: true,
        timeout: 500,
        ajax: {
          url: "{{ route('datatable.laporan') }}",
          data: {
            start_date: from_date,
            end_date: to_date
          },
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'statu',
            name: 'statu'
          },
          {
            data: 'nama',
            name: 'nama'
          },
          {
            data: 'no_hp',
            name: 'no_hp'
          },
          {
            data: 'created_at',
            name: 'created_at'
          },
          {
            data: 'gbr',
            name: 'gbr',
            orderable: false,
            searchable: false
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          }
        ]
      });
    }
  });
</script>
<script>
  $(document).ready(function() {
    $('.lihat_img').magnificPopup({
      type: 'image'
    });
  });
</script>

@endsection