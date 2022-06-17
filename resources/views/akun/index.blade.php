@extends('adminlte::page')

@section('title', 'Akun')

@section('content_header')

@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      @include(' alert')
      <!-- COLOR PALETTE -->
      <div class="card card-default color-palette-box">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-book"></i>
            Data Akun
          </h3>
        </div>
        <div class="card-body">
            <a href="{{ url('akun/create') }}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Akun</a>
            <div class="float-right">
                <form action="{{ url('akun/cari') }}" class="form-inline" method="GET">
                    {{ @csrf_field() }}
                <div class="input-group input-group">
                    <input type="text" name="q" value="{{ old('q')}}" class="form-control">
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-flat mb-2"><i class="fas fa-search"></i>Cari</button>

                </form>
            </div>
          </div>
          <table class="table table-sm table-hover ">
              <thead>
                <tr>
                  <th scope="col" valign="middle">#</th>
                  <th scope="col">NIK</th>
                  <th scope="col">NAMA</th>
                  <th scope="col">ALAMAT</th>
                  <th scope="col">EMAIL</th>
                  <th scope="col">STATUS</th>
                  <th scope="col" colspan="2">AKSI</th>
                  
                </tr>
              </thead>
              @foreach ($akuns as $no=>$akun)
              <tbody>
                <tr>
                  <th scope="row" valign="middle">{{ ++$no +($akuns->currentPage()-1)*$akuns->perPage() }}</th>
                  <td>
                    {{ $akun->nik }}<br>
                    
                  </td>
                  <td>
                    {{ $akun->name }}
                  </td>
                  <td>
                    {{ $akun->alamat }}
                  </td>
                  <td>
                    {{ $akun->email }}
                  </td>
                  <?php
                  $status= $akun->is_admin ;
                  if ($status=="1"){
                    $statusnya="<span class='badge badge-info'>Admin</span>";
                  }else{
                    $statusnya="<span class='badge badge-success'>Tamu</span>";
                  }                  
                  ?>
                  <td>
                    {!! $statusnya !!}
                  </td>
                  <td width="5%">
                    <a href="{{url('/akun/'.$akun->id.'/edit')}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>  
                  </td>
                  <td width="5%">
                    <form action="{{url('/akun/'.$akun->id.'/delete')}}" method="POST">
                      @csrf
                      @method("DELETE")
                      <button type="submit" onclick="return confirm('Anda Yakin?')" class= "btn btn-danger"><i class="fa fa-trash"></i></button>                             
                      </form>
                 </td>
                  </tr>
              </tbody>
              @endforeach
            </table><hr>
            <div class="d-flex justify-content-center">{{ $akuns->withQueryString()->links('vendor.pagination.bootstrap-4') }}</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@stop
