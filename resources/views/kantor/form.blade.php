@extends('adminlte::page')

@section('title', 'Tambah Master')

@section('content_header')
    
@stop

@section('content')
<!-- Main content -->
<div class="row"> <!-- class row digunakan sebelum membuat column  -->
    <div class="col-4"> <!-- ukuruan layar dengan bootstrap adalah 12 kolom, bagian kiri dibuat sebesar 4 kolom-->
        <div class="jumbotron"> <!-- untuk membuat semacam container berwarna abu -->
        <h1>Pos Jaga </h1>
        <hr>
            <form action="{{url('/kantor/store')}}" method="post">
                {{ @csrf_field() }}
                <div class="form-group">
                    <label for="exampleFormControlInput1">Latitude, Longitude</label>
                    <input type="text" class="form-control" id="lng" name="latitude">
                    <input type="text" class="form-control" id="lat" name="longitude">
                    
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Alamat</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Tempat</label>
                    <input type="text" class="form-control" name="nama">
                    <input type="hidden" class="form-control" name="image">
                </div>
                
                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Tambah</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-8"> <!-- ukuruan layar dengan bootstrap adalah 12 kolom, bagian kiri dibuat sebesar 4 kolom-->
        <!-- peta akan ditampilkan dengan id = mapid -->
        <div id="mapid" style="width: 100%; height: 400px"></div>
    </div>
</div>
<script type = "text/javascript" language="javascript">
    
      
      var mymap = L.map("mapid").setView([-7.0656509, 107.4562707], 10);      
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
    
          var popup = L.popup();

// buat fungsi popup saat map diklik
function onMapClick(e) {
    popup
    
 
         .setLatLng(e.latlng)
         .setContent("koordinatnya adalah " + e.latlng
             .toString()
                 ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
         .openOn(mymap);
         var coord = e.latlng.toString().split(',');
var lat = coord[0].split('(');
var lng = coord[1].split(')');
    document.getElementById('lat').value = lat[1] //value pada form latitde, longitude akan berganti secara otomatis
    document.getElementById('lng').value = lng[0] //value pada form latitde, longitude akan berganti secara otomatis
}
mymap.on('click', onMapClick);
    
      
    
    </script>
@stop
