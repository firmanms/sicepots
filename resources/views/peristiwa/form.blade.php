@extends('adminlte::page')
@section('plugins.TempusDominusBs4', true)
@section('title', 'Tambah Peristiwa')

@section('content_header')
    
@stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Peristiwa</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                {{-- <img class="profile-user-img img-fluid img-circle"
                     src="../../dist/img/user4-128x128.jpg"
                     alt="User profile picture"> --}}
              </div>

              

              <form action="{{url('/peristiwa/store')}}" method="post" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tanggal Aduan</label>
                    {{-- Minimal --}}
                    @php
                    $config = ['format' => 'YYYY-MM-DD hh:mm:ss'];
                    @endphp
                    <x-adminlte-input-date name="tgl_aduan"  id="tgl_aduan" :config="$config"/>
                    @error('tgl_aduan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    {{-- Disabled with predefined value --}}
                    
                    
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Latitude, Longitude</label>
                    <input type="text" required class="form-control" id="lng" name="latitude">
                    <input type="text" required class="form-control" id="lat" name="longitude">
                    
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik">
                    @error('nik')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                    @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                    @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">No Kontak</label>
                    <input type="text" class="form-control" id="nohp" name="nohp">
                    @error('nohp')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Jenis Aduan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_aduan" value="greenIcon" checked>
                        <label class="form-check-label">Penyelamatan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_aduan" value="redIcon">
                        <label class="form-check-label">Kebakaran</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Status Aduan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="0" checked>
                        <label class="form-check-label">Baru</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="1">
                        <label class="form-check-label">Proses</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="2">
                        <label class="form-check-label">Selesai</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                    @error('keterangan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Gambar</label>
                    <input type="text" class="form-control" id="nohp" name="image" value="null">
                    <input type="text" class="form-control" id="nohp" name="path" value="null">
                    {{-- <input type="file" name="filetoupload" id="filetoupload">
                    @error('filetoupload')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror                     --}}
                </div>        
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                </div>
            </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header p-2">
              Lokasi
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <div id="mapid" style="width: 100%; height: 600px"></div>
                </div>                
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
<!-- Main content -->
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
