@extends('layouts.master')
@section('title')
    K-BIL | Kehadiran
@endsection
@section('content-header')
    <h1>
        Kehadiran
        <small>Detail</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Kehadiran</li>
        <li>Detail</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title">
                </h3>
                <a href="{{ route('kehadiran.index') }}" class="btn btn-warning btn-sm pull-right"><span
                        class="fa fa-undo"></span> Kembali</a>
            </div>
            <div class="box-body">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <img class="profile-user-img img-responsive img-circle" src=""
                        alt="User profile picture" id="imgUser">

                    <h3 class="profile-username text-center" id="nameUser"></h3>

                    <p class="text-muted text-center" id="jabatanUser"></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>NIP</b> <a class="pull-right" id="nipUser"></a>
                        </li>
                        <li class="list-group-item">
                            <b>NUPTK</b> <a class="pull-right" id="nuptkUser"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <div class="row">
                        <h3 class="text-center">Absen Masuk </h3>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <img class="profile-user-img img-responsive" src="{{ asset('storage/users/default.jpg') }}"
                                    alt="User profile picture">
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">Waktu Absen</div>
                                    <div class="col-md-6 col-sm-12" id="waktuMasuk"></div>
                                    <div class="col-md-4 col-sm-12">Longitude</div>
                                    <div class="col-md-6 col-sm-12" id="longMasuk"></div>
                                    <div class="col-md-4 col-sm-12">Latitude</div>
                                    <div class="col-md-6 col-sm-12" id="latMasuk"></div>
                                    <div class="col-md-4 col-sm-12">Jarak</div>
                                    <div class="col-md-6 col-sm-12">500 m</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h3 class="text-center">Absen Keluar </h3>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <img class="profile-user-img img-responsive" src="{{ asset('storage/users/default.jpg') }}"
                                    alt="User profile picture">
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">Waktu Absen</div>
                                    <div class="col-md-6 col-sm-12" id="waktuKeluar"></div>
                                    <div class="col-md-4 col-sm-12">Longitude</div>
                                    <div class="col-md-6 col-sm-12" id="longKeluar"></div>
                                    <div class="col-md-4 col-sm-12">Latitude</div>
                                    <div class="col-md-6 col-sm-12" id="latKeluar"></div>
                                    <div class="col-md-4 col-sm-12">Jarak</div>
                                    <div class="col-md-6 col-sm-12">500 m</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('externaljs')
    <script>
        let base = new URL(window.location.href);
        var storagePath = "{!! asset('storage/users/') !!}";
        var storageAbsen = "{!! asset('storage/absen/') !!}"
        let path = base.pathname;
        let segment = path.split("/");
        let kehadiranId = segment["2"];
        let url = baseUrl + listRoutes['kehadiran.detail'].replace('id', kehadiranId);
        $.getJSON(url, function(res){

        }).done(function(res){
            console.log(res)
            const dataUser = res.data[0].user;
            const dataAbsen = res.data[0];
            getUser(dataUser)
            getAbsensi(dataAbsen)
        }).fail(function(res){
            console.log(res)
        })
        function getUser(data){
            $('#nameUser').html(data.nama_lengkap)
            $('#jabatanUser').html(data.jabatan.jabatan)
            $('#nipUser').html(data.nip)
            $('#nuptkUser').html(data.nuptk)
            $('#imgUser').prop('src', storagePath+'/'+data.fotos)
        }
        function getAbsensi(data){
            $('#waktuMasuk').html(data.waktu_masuk);
            $('#longMasuk').html(data.longitude_masuk);
            $('#latMasuk').html(data.longitude_masuk);

            if(data.waktu_keluar == null){
                $('#waktuKeluar').html('-')
            } else {
                $('#waktuKeluar').html(data.waktu_keluar);
            }
            if(data.longitude_keluar == null){
                $('#longKeluar').html('-')
            } else {
                $('#longKeluar').html(data.longitude_keluar);
            }
            if(data.latitude_keluar == null){
                $('#latKeluar').html('-')
            } else {
                $('#latKeluar').html(data.latitude_keluar);
            }
        }
    </script>
@endpush
