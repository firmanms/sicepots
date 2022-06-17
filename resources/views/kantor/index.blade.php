@extends('adminlte::page')

@section('title', 'Kantor')

@section('content_header')

@stop

@section('content')
<!-- Main content -->
<section class="content">
  <br>
  <div class="container-fluid">
    @if(auth()->user()->is_admin == 1)
    <div class="row">       
        <div class="col-12 col-sm-6 col-md-12">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-yellow elevation-1"><i class="fas fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pos Jaga</span>
              <span class="info-box-number">{{ $countpos }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      
      <!-- /.row -->

      <div id="mapid" style="width: 100%; height: 400px"></div>
    
    
                    
    @else

    @endif
 @stop

 @section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

@stop
                    
@section('js')
<script type = "text/javascript" language="javascript"> 
  var hydrant = new L.Icon({
    iconUrl: '{{url('images/damkar_kantor.png')}}',
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
      $.getJSON('kantor/json', function(data){
        $.each(data, function(index,data){
          
          var marker = L.marker([data.longitude,data.latitude],{icon: hydrant}).addTo(mymap);
          marker.bindPopup(data.alamat).closePopup();
        });

      });
  });
  
//L.marker(new L.LatLng(-7.0256488, 107.5230432),{draggable: true},).addTo(mymap);

</script>
    
      @include(' alert')
      <!-- COLOR PALETTE -->
      <div class="card card-default color-palette-box">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-book"></i>
            Data Kantor
          </h3>
        </div>
        <div class="card-body">
            <a href="{{ url('kantor/create') }}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Kantor</a>
            <div class="float-right">
                <form action="{{ url('kantor/cari') }}" class="form-inline" method="GET">
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
                  <th scope="col">NAMA</th>
                  <th scope="col">ALAMAT</th>
                  <th scope="col" colspan="2">AKSI</th>
                  
                </tr>
              </thead>
              @foreach ($kantors as $no=>$kantor)
              <tbody>
                <tr>
                  <th scope="row" valign="middle">{{ ++$no +($kantors->currentPage()-1)*$kantors->perPage() }}</th>
                  <td>
                    {{ $kantor->nama }}<br>
                    
                  </td>
                  <td>
                    {{ $kantor->alamat }}
                  </td>
                  <td width="5%">
                    <a href="{{url('/kantor/'.$kantor->id.'/edit')}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>  
                  </td>
                  <td width="5%">
                    <form action="{{url('/kantor/'.$kantor->id.'/delete')}}" method="POST">
                      @csrf
                      @method("DELETE")
                      <button type="submit" onclick="return confirm('Anda Yakin?')" class= "btn btn-danger"><i class="fa fa-trash"></i></button>                             
                      </form>
                 </td>
                  </tr>
              </tbody>
              @endforeach
            </table><hr>
            <div class="d-flex justify-content-center">{{ $kantors->withQueryString()->links('vendor.pagination.bootstrap-4') }}</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@stop
