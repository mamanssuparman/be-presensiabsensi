@extends('layouts.master')
@section('title')
    K-BIL | Karyawan
@endsection
@section('content-header')
    <h1>
        Karyawan
        <small>Detail Karyawan</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Karyawan</li>
        <li>Detail</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="col-md-4 col-lg-4 col-sm-12">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src=""
                        alt="User profile picture" id="image_user">

                    <h3 class="profile-username text-center" id="nama"></h3>

                    <p class="text-muted text-center" id="jabatan"></p>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
                    <li><a href="#timeline" data-toggle="tab">Account</a></li>
                    <li><a href="#settings" data-toggle="tab">Change Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <form id="form-update-profile">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form form-control" placeholder="NIP">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuptk">NUPTK</label>
                                    <input type="text" name="nuptk" id="nuptk" class="form form-control" placeholder="NUPTK">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form form-control" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label> <br>
                                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="Laki-laki"> Laki-laki
                                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_peremapun" value="Perempuan"> Perempuan
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" name="nomor_telepon" id="nomor_telepon" class="form form-control" placeholder="Nomor Telepon">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" id="jabatan" class="form form-control">
                                        <option value="">-- Pilih Jabatan --</option>
                                        @foreach ($jabatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="4" class="form form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form form-control">
                                        <option value="">-- Pilih Role --</option>
                                        <option value="1">Kepala Sekolah</option>
                                        <option value="2">Admin</option>
                                        <option value="3">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status">Status</label> <br>
                                    <input type="radio" name="statususer" id="statususeraktif" value="1"> Aktif
                                    <input type="radio" name="statususer" id="statususernonaktif" value="2"> Non Aktif
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary btn-md" type="submit"><span class="fa fa-save"></span> Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <form action="" id="form-change-email">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form form-control">
                                    <small class="text-danger text-xs" id="errEmail"></small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-save"></span>Perbaharui</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <button class="btn btn-primary"><span class="fa fa-refresh"></span> Reset Password</button>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </section>
@endsection
@push('externaljs')
    <script src="{{ asset('assets/bower_components/jqueryvalidate/jquery.validate.js') }}"></script>
    <script type="text/javascript">
    let base = new URL(window.location.href);
    var storagePath = "{!! asset('storage/users/') !!}";
    let path = base.pathname;
    let segment = path.split("/");
    let karyawanId = segment["2"];
    let url = baseUrl + listRoutes['karyawan.detail'].replace('id',karyawanId);
    $.getJSON(url, function(res){
    }).done(function(res){
        $('#nip').val(res.data[0].nip)
        $('#nuptk').val(res.data[0].nuptk)
        $('#nama_lengkap').val(res.data[0].nama_lengkap)
        if(res.data[0].jenis_kelamin == 'Laki-laki'){
            $('#jenis_kelamin_laki').prop("checked", true)
        }{
            $('#jenis_kelamin_perempuan').prop("checked", true)
        }
        $('#nomor_telepon').val(res.data[0].notelepon)
        $('#jabatan').val(res.data[0].jabatansid)
        $('#alamat').val(res.data[0].alamat)
        $('#role').val(res.data[0].role)
        if(res.data[0].statususers == '1'){
            $('#statususeraktif').prop("checked", true)
        }else{
            $('#statususernonaktif').prop("checked", true)
        }
        $('#nama').html(res.data[0].nama_lengkap)
        $('#image_user').prop('src', storagePath+'/'+res.data[0].fotos)
        $('#email').val(res.data[0].email)
    }).fail(function(res){
        alert('Gagal mengambil data')
    })
    $('#form-update-profile').validate({
        rules:{
            'nip': 'required',
            'nuptk': 'required',
            'nama_lengkap': 'required',
            'nomor_telepon': 'required',
            'jabatan': 'required',
            'alamat': 'required',
            'role': 'required'
        },
        submitHandler: function(){
            var url = baseUrl + listRoutes['karyawan.update'].replace('id', karyawanId);
            // var dataUpdate = new FormData($('#form-update-profile')[0]);
            $.ajax({
                url: url,
                type: 'post',
                dataType: "JSON",
                data: new FormData($('#form-update-profile')[0]),
                processData: false,
                contentType: false,
                success: function(res){
                    console.log(res)
                    // location.reload()
                },
                error: function(res){
                    alert('gagal')
                }
            })
        }

    })
    $('#form-change-email').validate({
        rules: {
            'email': 'required'
        },
        submitHandler:function(){
            let url = baseUrl + listRoutes['karyawan.changeemail'].replace('id', karyawanId);
            $.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    email: $('#email').val()
                },
                success: function(res){

                    if(res.meta.code == 500){
                        $('#errEmail').html("email sudah dipergunakan")
                    } else {
                        location.reload()
                    }
                },
                error: function(res){
                    alert('gagal')
                }
            })
        }
    })
    </script>
@endpush
