@extends('layouts.master')
@section('cssexternal')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        /* #map {
                    height: 500px;
                    width: 100%;
                } */
        .leaflet-container {
            height: 400px;
            width: 100%;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@endsection
@section('title')
    K-BIL | Absensi
@endsection
@section('content-header')
    <h1>
        Master
        <small>Absensi</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Absensi</li>
        <li>Index</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="col-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <form id="form-update-masterabsensi">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="jam-masuk">Maximal Jam Masuk</label>
                                    <input type="time" name="jammasuk" id="jam-masuk" class="form form-control">
                                </div>
                                <div class="form-group">
                                    <label for="jam-keluar">Maximal Jam Keluar</label>
                                    <input type="time" name="jamkeluar" id="jam-keluar" class="form form-control">
                                </div>
                                <div class="form-group">
                                    <label for="jarakabsen">Jarak Absen</label>
                                    <input type="number" name="jarakabsen" id="jarakabsen" class="form form-control">
                                    <small class="text-danger">dalam satuan meter (m)</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" name="latitude" id="latitude" class="form form-control">
                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" name="longitude" id="longitude" class="form form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-md pull-right" type="submit"><span
                                            class="fa fa-save"></span>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-12">
                        <div id="map" class="leaflet-container"></div>
                    </div>
                    <!-- Row Map -->
                </div>
            </div>
        </div>

    </section>
@endsection
@push('externaljs')
    <script src="{{ asset('assets/bower_components/jqueryvalidate/jquery.validate.js') }}"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script type="text/javascript">
        let base = new URL(window.location.href);
        var storagePath = "{!! asset('storage/users/') !!}";
        let path = base.pathname;
        let cekLatitude = $('#latitude').val();
        //getDataJSON
        console.log("cek Latitude sebelum getdata " + cekLatitude);
        function getJsonData(){
            $.getJSON(baseUrl + listRoutes['absensi.getData'], function(e) {
                console.log(e)
                $('#latitude').val(e.data[0].latitude);
                $('#longitude').val(e.data[0].langitude);
                $('#jam-masuk').val(e.data[0].jam_masuk);
                $('#jam-keluar').val(e.data[0].jam_keluar);
                $('#jarakabsen').val(e.data[0].jarakabsen);
            })
        }
        getJsonData()
        cekLatitude = $('#latitude').val()
        console.log("cek Latitude sesudah getdata " + cekLatitude);
        //untuk maps
        let latitude = -7.351564695753717
        let longitude = 108.63515798523339
        var zoomLevel = 13;
        var map = L.map('map').setView([latitude, longitude], zoomLevel);

        // Menambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Menambahkan marker di koordinat yang ditentukan
        var marker = L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Lokasi Kantor.')
            .openPopup();

        map.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            // updateMarker(latitude, longitude);
        })
        $('#form-update-masterabsensi').validate({
            rules: {
                jammasuk: 'required',
                jamkeluar: 'required',
                jarakabsen: 'required',
            },
            submitHandler: function(){
                var url = baseUrl + listRoutes['absensi.update'];
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: new FormData($('#form-update-masterabsensi')[0]),
                    contentType: false,
                    processData: false,
                    success: function(res){
                        alert('Update data successfuly')
                    },
                    error: function(res){
                        alert('Gagal')
                    }
                })
            }
        })
    </script>
@endpush
