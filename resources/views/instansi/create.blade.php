@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Instansi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Instansi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Instansi</h3>
                        </div>
                        <form action="{{ route('admin.instansi.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_instansi">Nama Instansi</label>
                                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Masukkan Nama Instansi">
                                    @error('nama_instansi')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">
                                    @error('alamat')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No Telp</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Telp">
                                    @error('no_telp')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="kota">Kota</label>
                                  <input type="text" class="form-control" id="kota" name="kota" placeholder="Masukkan Kota">
                                  @error('kota')
                                     <small class="text-danger">{{ $message }}</small>
                                  @enderror
                              </div>
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" readonly>
                                    @error('latitude')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" readonly>
                                    @error('longitude')
                                       <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Pilih Lokasi Perusahaan pada Peta</label>
                                    <div id="map"></div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Initialize map
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                center: {lat: -6.930601838350512, lng: 110.7925271987915}, // Default center (SMK Negeri 3 Kudus)
                                                zoom: 15
                                            });
                                    
                                            var marker = new google.maps.Marker({
                                                map: map,
                                                draggable: true,
                                                animation: google.maps.Animation.DROP,
                                                position: {lat: -6.930601838350512, lng: 110.7925271987915} // Default position (SMK Negeri 3 Kudus)
                                            });
                                    
                                            // Update latitude and longitude when marker is dragged
                                            marker.addListener('dragend', function() {
                                                var latLng = marker.getPosition();
                                                document.getElementById('latitude').value = latLng.lat();
                                                document.getElementById('longitude').value = latLng.lng();
                                            });
                                    
                                            // Update marker position and input fields when map is clicked
                                            map.addListener('click', function(event) {
                                                var lat = event.latLng.lat();
                                                var lng = event.latLng.lng();
                                                marker.setPosition({lat: lat, lng: lng});
                                                document.getElementById('latitude').value = lat;
                                                document.getElementById('longitude').value = lng;
                                            });
                                    
                                            // Use geolocation to set the initial position of the map
                                            if (navigator.geolocation) {
                                                navigator.geolocation.getCurrentPosition(function(position) {
                                                    var lat = position.coords.latitude;
                                                    var lng = position.coords.longitude;
                                                    map.setCenter({lat: lat, lng: lng});
                                                    marker.setPosition({lat: lat, lng: lng});
                                                    document.getElementById('latitude').value = lat;
                                                    document.getElementById('longitude').value = lng;
                                                }, function() {
                                                    alert('Geolocation failed. Defaulting to SMK Negeri 3 Kudus.');
                                                });
                                            } else {
                                                alert('Your browser does not support geolocation. Defaulting to SMK Negeri 3 Kudus.');
                                            }
                                        });
                                    </script>
                                    
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOVYRIgupAurZup5y1PRh8Ismb1A3lLao&libraries=places"></script>
                                    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> --}}
                                    <style>
                                        #map {
                                            height: 500px;
                                        }
                                    </style>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('s')



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize map
        var map = L.map('map').setView([-6.930601838350512, 110.7925271987915], 15); // Default to SMK Negeri 3 Kudus

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Create a draggable marker
        var marker = L.marker([-6.930601838350512, 110.7925271987915], {draggable: true}).addTo(map);

        // Update latitude and longitude when marker is dragged
        marker.on('dragend', function(event) {
            var latLng = marker.getLatLng();
            document.getElementById('latitude').value = latLng.lat;
            document.getElementById('longitude').value = latLng.lng;
        });

        // Update marker position and input fields when map is clicked
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            marker.setLatLng([lat, lng]);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Use geolocation to set the initial position of the map
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                map.setView([lat, lng], 15);
                marker.setLatLng([lat, lng]);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }, function() {
                alert('Geolocation failed. Defaulting to SMK Negeri 3 Kudus.');
            });
        } else {
            alert('Your browser does not support geolocation. Defaulting to SMK Negeri 3 Kudus.');
        }
    });
</script>

@endsection
@section('scripts')
    
    <!-- Script untuk menampilkan alert berdasarkan session -->
    @if(session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('error') }}",
            });
        </script>
    @endif

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if($errors->has('nama_jurusan'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "{{ $errors->first('nama_jurusan') }}",
            });
        </script>
    @endif
@endsection
