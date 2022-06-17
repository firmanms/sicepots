@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Peristiwa</h1>
@stop

@section('content')

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
        <!-- /.col -->
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div id="mapid" style="width: 100%; height: 400px"></div>
    
    <a href="{{url('admin/routes')}}">Admina</a>
                    
    @else
<div class=”panel-heading”>Normal User</div>
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

@stop
