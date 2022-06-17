@extends('adminlte::page')

@section('title', 'Peristiwa')

@section('content_header')

@stop

@section('content')
<!-- Main content -->
<section class="content">
  <br>
  <div class="container-fluid">
    @if(auth()->user()->is_admin == 1)
    <div class="row">       
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box">
          <span class="info-box-icon bg-red elevation-1"><i class="fas fa-fire"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Lap. Kabakaran</span>
            <span class="info-box-number">
              {{ $countkebakaran }}
              
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-heart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Lap. Penyelamatan</span>
            <span class="info-box-number">{{ $countpenyelematan }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div id="mapid" style="width: 100%; height: 400px"></div>              
    @else
    @endif
 @stop
 @section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop                 
@section('js')
<script type = "text/javascript" language="javascript"> 
  var kebakaran = new L.Icon({
    iconUrl: '{{url('images/fire.png')}}',
    //shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 25],
    //iconAnchor: [12, 41],
    //popupAnchor: [1, -34],
    //shadowSize: [41, 41]
  });
  var rescue = new L.Icon({
    iconUrl: '{{url('images/damkar_rescue.png')}}',
    //shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 25],
    //iconAnchor: [12, 41],
    //popupAnchor: [1, -34],
    //shadowSize: [41, 41]
  });  
  
  var mymap = L.map("mapid").setView([-7.0656509, 107.4562707], 10);      
 
  //L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
  //maxZoom: 20,
  //subdomains:['mt0','mt1','mt2','mt3']
  //}).addTo(mymap);
 L.tileLayer(
        "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
        {
          maxZoom: 18,
          attribution:
            'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          id: "mapbox/streets-v11",
         tileSize: 512,
         zoomOffset: -1,
       }
      ).addTo(mymap);
      $( document ).ready(function() {
    setInterval(function() {
      $.getJSON('aduan/json', function(data){
        $.each(data, function(index,data){
          console.log(data);
         // return false;
         if (data.jenis_aduan=="redIcon"){
          var marker = L.marker([data.longitude,data.latitude],{icon: kebakaran}).addTo(mymap);
          marker.bindPopup(data.alamat).closePopup();
         }else{
          var marker = L.marker([data.longitude,data.latitude],{icon: rescue}).addTo(mymap);
          marker.bindPopup(data.alamat).closePopup();
         }
        
        });
      
      });
    }, 1000);
  });
  
//L.marker(new L.LatLng(-7.0256488, 107.5230432),{draggable: true},).addTo(mymap);

</script>

@include(' alert')
<!-- COLOR PALETTE -->
<div class="card card-default color-palette-box">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fas fa-book"></i>
      Data Peristiwa
    </h3>
  </div>
  <div class="card-body">
      <a href="{{ url('peristiwa/create') }}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Peristiwa</a>
      <div class="float-right">
          <form action="{{ url('peristiwa/cari') }}" class="form-inline" method="GET">
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
            <th scope="col">PELAPOR</th>
            <th scope="col">ALAMAT</th>
            <th scope="col">NO KONTAK</th>
            <th scope="col">JENIS ADUAN<br>STATUS ADUAN</th>
            <th scope="col">KET</th>
            <th scope="col" colspan="2">AKSI</th>
            
          </tr>
        </thead>
        @foreach ($peristiwas as $no=>$peristiwa)
        <tbody>
          <tr>
            <th scope="row" valign="middle">{{ ++$no +($peristiwas->currentPage()-1)*$peristiwas->perPage() }}</th>
            <td>
              {{ $peristiwa->nama }}                    
            </td>
            <td>
              {{ $peristiwa->alamat }}
            </td>
            <td>
              {{ $peristiwa->nohp }}                    
            </td>
            <?php
                  $jenis= $peristiwa->jenis_aduan ;
                  if ($jenis=="greenIcon"){
                    $jenisnya="<span class='badge badge-info'>Penyelamatan</span>";
                  }else{
                    $jenisnya="<span class='badge badge-danger'>Kebakaran</span>";
                  }
                  $status= $peristiwa->status ;
                  if ($status=="0"){
                    $statusnya="<span class='badge badge-primary'>Baru</span>";
                  }else if($status=="1"){
                    $statusnya="<span class='badge badge-warning'>Proses</span>";
                  }else{
                    $statusnya="<span class='badge badge-success'>Selesai</span>";
                  }
            ?>
            <td>
              {!! $jenisnya !!}<br>
              {!! $statusnya !!}
            </td>
            <td>
              {{ $peristiwa->keterarangan }}                    
            </td>
            <td width="5%">
              <a href="{{url('/peristiwa/'.$peristiwa->id.'/edit')}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>  
            </td>
            <td width="5%">
              <form action="{{url('/peristiwa/'.$peristiwa->id.'/delete')}}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit" onclick="return confirm('Anda Yakin?')" class= "btn btn-danger"><i class="fa fa-trash"></i></button>                             
                </form>
           </td>
            </tr>
        </tbody>
        @endforeach
      </table><hr>
      <div class="d-flex justify-content-center">{{ $peristiwas->withQueryString()->links('vendor.pagination.bootstrap-4') }}</div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
  

@stop
