@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="container-fluid">
    @if(auth()->user()->is_admin == 1)
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-red elevation-1"><i class="fas fa-fire"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kebakaran</span>
              <span class="info-box-number">
                10
                
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-heart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Penyelamatan</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-yellow elevation-1"><i class="fas fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pos Jaga</span>
              <span class="info-box-number">6</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-tint"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Hydrant</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div id="mapid" style="width: 100%; height: 400px"></div>
    <script>
      
      var greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });
  var redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });
  var blueIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });
  var yellowIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });
      var mymap = L.map("mapid").setView([-7.0627073, 107.3109679], 10);      
      var marker = L.marker(new L.LatLng(-7.0256488, 107.5230432),{draggable: true},).addTo(mymap);
     // var marker3 = L.marker(new L.LatLng(-7.1256448, 107.5230432),{icon: redIcon}).addTo(mymap);
      //var marker3 = L.marker(new L.LatLng(-7.1351448, 107.4230432),{icon: yellowIcon}).addTo(mymap);
      //var marker3 = L.marker(new L.LatLng(-7.1458448, 107.6230432),{icon: greenIcon}).addTo(mymap);
      //marker.bindPopup("Jl. aaaaa").openPopup();
      $( document ).ready(function() {
          $.getJSON('aduan/json', function(data){
            $.each(data,function(index){
              L.marker([data[index].longitude,data[index].latitude]).addTo(mymap);

            });

          });
      });
      //L.tileLayer(
      //  "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
      //  {
     //     maxZoom: 18,
      //    attribution:
      //      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      //      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      //      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      //    id: "mapbox/streets-v11",
      //    tileSize: 512,
      //    zoomOffset: -1,
      //  }
      //).addTo(mymap);
      
      L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(mymap);

    </script>
    <a href="{{url('admin/routes')}}">Admina</a>
                    
    @else
<div class=”panel-heading”>Normal User</div>
    @endif
 @stop

 @section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

@stop
                    
@section('js')
<script> console.log('Hi!'); </script>

@stop
