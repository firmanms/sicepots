@extends('adminlte::page')

@section('title', 'Ubah Kantor')

@section('content_header')
    
@stop

@section('content')
<!-- Main content -->
<div class="row"> <!-- class row digunakan sebelum membuat column  -->
    <div class="col-4"> <!-- ukuruan layar dengan bootstrap adalah 12 kolom, bagian kiri dibuat sebesar 4 kolom-->
        <div class="jumbotron"> <!-- untuk membuat semacam container berwarna abu -->
        <h1>Pos Jaga </h1>
        <hr>
        <form action="{{url('/kantor/'.$kantor->id.'/update')}}" method="post">
            @method("PUT")
            {{ @csrf_field() }}
                <div class="form-group">
                    <label for="exampleFormControlInput1">Latitude, Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="latitude" value="{{ old('latitude') ?? $kantor->latitude }}">
                    <input type="text" class="form-control" id="latitude" name="longitude" value="{{ old('longitude') ?? $kantor->longitude }}">
                    
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="{{ old('alamat') ?? $kantor->alamat }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Tempat</label>
                    <input type="text" class="form-control" name="nama"  value="{{ old('longitude') ?? $kantor->nama }}">
                    <input type="hidden" class="form-control" name="image">
                </div>
                
                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Ubah</button>
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
    var mapCenter = [
            {{ $kantor->longitude }},
            {{ $kantor->latitude }},
    ];
    var map = L.map('mapid').setView(mapCenter,{{ config('leafletsetup.zoom_level') }});
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
           }).addTo(map);
    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat,lng){
        marker
        .setLatLng([lat,lng])
        .bindPopup("Your location :" + marker.getLatLng().toString())
        .openPopup();
        return false;
    };
    map.on('click',function(e) {
        let latitude  = e.latlng.lat.toString().substring(0,15);
        let longitude = e.latlng.lng.toString().substring(0,15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude,longitude);
    });
    var updateMarkerByInputs = function () {
        return updateMarker( $('#latitude').val(), $('#longitude').val());
    }
    $('#latitude').on('input',updateMarkerByInputs);
    $('#longitude').on('input',updateMarkerByInputs); 
    </script>
@stop
