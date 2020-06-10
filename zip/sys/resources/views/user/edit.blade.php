@extends('layouts.app')

@section('content')
	<section class="section">
	  <h1 class="section-header">
	    <div>User</div>
	  </h1>
	  <div class="row">
		  <div class="col-12">
       <form method="post" action="{{ route('user.update', $data->id) }}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="card">
          <div class="card-header">
            <h4>Edit User</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <h7>Nama</h7>
              <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $data->name }}" required>
              @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group">
              <h7>NIK</h7>
              <input type="text" name="nik" class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" value="{{ $data->nik }}" required>
              @if ($errors->has('nik'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('nik') }}</strong>
                  </span>
              @endif
            </div>
            <!-- <div class="form-group">
              <h7>Jenis Kelamin</h7>
                  <div>
                    <h8 class="radio-inline">
                      <input type="radio" name="jk" id="jk" value="2" required> Laki-laki
                    </h8>
                    <h8 class="radio-inline">
                      <input type="radio" name="jk"  id="jk" value="1"> Perempuan
                    </h8>
                  </div>
            </div> -->
            <div class="form-group">
              <h7>Email</h7>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}" tabindex="1" required>

               @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group">
              <h7 class="d-block">Password</h7>
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" tabindex="2" required>

              @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group">
              <h7 class="d-block">Alamat</h7>
              <textarea name="alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}">
                {{$data->alamat}}
              </textarea>

              @if ($errors->has('alamat'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('alamat') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
	  </div>
	</section>

@endsection

@section('js')
@endsection
