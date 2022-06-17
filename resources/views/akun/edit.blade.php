@extends('adminlte::page')

@section('title', 'Ubah Akun')

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
    <form action="{{url('/akun/'.$akun->id.'/update')}}" method="post">
        @method("PUT")
        {{ @csrf_field() }}
      <div class="card-body">
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="nik" class="form-control" id="nik" required name="nik" placeholder="NIK" value="{{ old('nik') ?? $akun->nik }}">
          @error('nik')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="nama" class="form-control" id="name" required name="name" placeholder="Nama" value="{{ old('name') ?? $akun->name }}">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" required name="alamat" placeholder="Alamat" >{{ old('alamat') ?? $akun->alamat }}</textarea>
            @error('alamat')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="nohp">No Telepon</label>
            <input type="nohp" class="form-control" id="nohp" required name="nohp" placeholder="089xxxxx" value="{{ old('nohp') ?? $akun->nohp }}">
            @error('nohp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" required name="email" placeholder="admin@mail.com" value="{{ old('email') ?? $akun->email }}">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_admin" value="0" {{ ($akun->is_admin=="0")? "checked" : "" }}>
                <label class="form-check-label">Tamu</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_admin" value="1" {{ ($akun->is_admin=="1")? "checked" : "" }}>
                <label class="form-check-label">Admin</label>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Kata Sandi</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
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
