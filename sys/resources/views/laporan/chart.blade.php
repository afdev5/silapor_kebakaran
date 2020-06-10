@extends('layouts.app')

@section('content')
<section class="section">
    <h1 class="section-header">
        <div>Rekapan Laporan</div>
    </h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('laporan.create') }}" class="pull-right btn btn-success btn-xs">Lihat Detail</a>
                    <div class="float-right">
                        <input type="text" name="daterange" class="form-control" value="01/01/2020 - 01/15/2020">
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
@endsection