@extends('adminlte::page')

@section('title', 'Tambah Master')

@section('content_header')
    
@stop

@section('content')
<br>
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Tambah Akun</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{url('/akun/store')}}" method="post">
        {{ @csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="nik" class="form-control" id="nik" name="nik" placeholder="NIK">
          @error('nik')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="nama" class="form-control" id="name" name="name" placeholder="Nama">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
            @error('alamat')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nohp">No Telepon</label>
            <input type="nohp" class="form-control" id="nohp" name="nohp" placeholder="089xxxxx">
            @error('nohp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="admin@mail.com">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_admin" value="0" checked>
                <label class="form-check-label">Tamu</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_admin" value="1">
                <label class="form-check-label">Admin</label>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Kata Sandi</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div> 
        {{-- <div class="form-group">
          <label for="password_confirmation">Ulangi Kata Sandi</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
        </div>             --}}
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
  <!-- /.card -->


@stop
