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
                  	<!-- <div class="float-right"> -->
                    <!-- <a href="{{ route('laporan.create') }}" class="pull-right btn btn-success btn-xs">Maps</a> -->
                    <!-- </div> -->
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="table" class="table table-bordered">
                      	<thead>
	                        <tr>
                            <th>No</th>
	                          <th>Nama</th>
                            <th>No Hp</th>
                            <th>Keterangan</th>
                            <th style="width: 100px">Gambar</th>
	                        </tr>
	                    </thead>
	                    <tbody>
                       @php
                          $no = 1;
                        @endphp
                        @foreach($data as $items)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $items->user['name'] }}</td>
                            <td>{{ $items->user['no_hp'] }}</td>
                            <td>{{ $items->keterangan }}</td>
                            <td><a class="lihat_img btn btn-sm btn-info" href="{{ asset('upload/'. $items->gambar) }}">Lihat</a></td>
                          </tr>

                          <!-- Modal -->
                                        <div class="modal fade" id="modal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- <h4 class="modal-title" align="center">Revisi Berkas</h4> -->
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('upload/'. $items->gambar) }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                            <span aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                        </form>
                                            </div>
                                        </div>
                                    </div>
                        @endforeach 
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
                $('#table').DataTable();
            });

            $(document).ready(function() {
              $('.lihat_img').magnificPopup({type:'image'});
            });
    </script>
@endsection
