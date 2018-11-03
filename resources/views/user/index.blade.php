@extends('layouts.app')

@section('content')
	<section class="section">
	  <h1 class="section-header">
	    <div>User</div>
	  </h1>
	  <div class="row">
		  <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  	<!-- <div class="float-right"> -->
                    <a href="{{ route('user.create') }}" class="pull-right btn btn-success btn-xs">Tambah User</a>
                    <!-- </div> -->
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="table" class="table table-bordered">
                      	<thead>
	                        <tr>
                            <th>No</th>
	                          <th>Nama</th>
                            <th>Nik</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
	                          <th style="width: 150px">#</th>
	                        </tr>
	                    </thead>
	                    <tbody>
                       @php
                          $no = 1;
                        @endphp
                        @foreach($data as $items)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $items->name }}</td>
                            <td>{{ $items->nik }}</td>
                            <td>{{ $items->no_hp }}</td>
                            <td>{{ $items->alamat }}</td>
                            <td>
                            <form action="{{ route('user.destroy', $items->id) }}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <a class="btn btn-sm btn-info" type="submit" href="{{ route('user.edit',$items->id) }}">Edit</a>
                              <button style="color:white;" class="btn btn-sm btn-warning" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                            </form>
                            </td>
                          </tr>
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
    </script>
@endsection
