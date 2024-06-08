@extends('layouts.master')
@section('title')
    K-BIL | Ajuan
@endsection
@section('content-header')
    <h1>
        Ajuan
        <small>Detail Ajuan Karyawan</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Ajuan</li>
        <li>Detail</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="col-md-4 col-lg-4 col-sm-12">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="" alt="User profile picture"
                        id="image_user">

                    <h3 class="profile-username text-center" id="nama"></h3>

                    <p class="text-muted text-center" id="jabatan"></p>
                    <h4 class=""><strong>Jenis Ajuan</strong></h4>
                    <p id="jenis_ajuans"></p>
                    <h4><strong> Tanggal Awal</strong></h4>
                    <p id="tanggal_ajuans"></p>
                    <h4><strong>Tanggal Akhir</strong></h4>
                    <p id="tanggal_akhir">untuk tanggal akhir</p>
                    <h4><strong>Status</strong></h4>
                    <select name="" id="statusajuan" class="form form-control" onchange="statusAjuan(this)">
                        <option value="">-- Pilih Status --</option>
                        <option value="2">Approve</option>
                        <option value="3">Tolak</option>
                    </select>
                    <div id="form-alasan">

                    </div>
                    <br>
                    <div id="button-proccess">
                        <button class="btn btn-primary btn-md pull-right" onclick="proccess()">Proccess</button>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-12">
            <div class="box box-primary">
                <div class="box-body">
                    <h4>Keterangan</h4>
                    <h5 id="keterangan">Keterangan Lampiran</h5>
                    <h4>Lampiran</h4>
                    <br>
                    <img src="" alt="" class="img-responsive" id="img_ajuans" alt="Image Ajuans">
                </div>
            </div>
        </div>
    </section>
@endsection
@push('externaljs')
    <script src="{{ asset('assets/bower_components/jqueryvalidate/jquery.validate.js') }}"></script>
    <script type="text/javascript">
        let base = new URL(window.location.href);
        var storagePath = "{!! asset('storage/users/') !!}";
        var storageAjuan = "{!! asset('storage/ajuans/') !!}"
        let path = base.pathname;
        let segment = path.split("/");
        let ajuanId = segment["2"];
        let url = baseUrl + listRoutes['ajuan.detail'].replace('id', ajuanId);
        $.getJSON(url, function(res){
        }).done(function(e){
            getDetailAjuans(e.data[0]);
        }).fail(function(e){
            console.log(e)
        })
        function getDetailAjuans(e){
            console.log(e)
            let iAjuans = e.jenis_ajuans;
            if(iAjuans == "1"){
                $('#jenis_ajuans').html('Sakit')
            } else if(iAjuans == "2"){
                $('#jenis_ajuans').html('Izin')
            } else {
                $('#jenis_ajuans').html('Dinas Luar')
            }
            $('#statusajuan').val(e.statusajuan)
            $('#tanggal_ajuans').html(e.tanggal_awal)
            $('#tanggal_akhir').html(e.tanggal_akhir)
            $('#nama').html(e.user.nama_lengkap)
            $('#image_user').prop('src', storagePath+'/'+e.user.fotos)
            $('#img_ajuans').prop('src', storageAjuan+'/'+e.lampiran)
        }
        function statusAjuan(x){
            if(x.value == "3"){
                $('#form-alasan').append(
                    `
                    <h4><strong>Alasan</strong></h4>
                        <textarea name="alasantolak" id="alasantolak" cols="30" rows="3" class="form form-control"></textarea>
                    `
                )
            }else {
                $('#form-alasan').html('')
            }
        }
        function proccess(){
            $.ajax({
                url: baseUrl+listRoutes['ajuan.update'].replace('{id}',ajuanId),
                type: "POST",
                dataType: "JSON",
                data: {
                    status: $('#statusajuan').val(),
                    alasan: $('#alasantolak').val()
                },
                success: function(e){
                    location.reload()
                },
                error: function(e){
                    console.log(e)
                }
            })
        }
    </script>
@endpush
