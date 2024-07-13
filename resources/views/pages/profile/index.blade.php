@extends('layouts.master')
@section('title')
    K-BIL | Profile
@endsection
@section('content-header')
    <h1>
        Profile
        <small>Detail Profile</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Profile</li>
        <li>Detail</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="" alt="User profile picture"
                            id="image_user">

                        <h3 class="profile-username text-center" id="nama"></h3>

                        <p class="text-muted text-center" id="jabatan"></p>
                        <form action="#" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="changepicture">Change Picture</label>
                                <input type="file" name="changepicture" id="changepicture" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-md btn-block mt-1">Change Picture</button>
                            </div>
                        </form>
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
                                        <input type="text" name="nip" id="nip" class="form form-control"
                                            placeholder="NIP">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nuptk">NUPTK</label>
                                        <input type="text" name="nuptk" id="nuptk" class="form form-control"
                                            placeholder="NUPTK">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            class="form form-control" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label> <br>
                                        <input type="radio" name="jenis_kelamin" id="jenis_kelamin_laki"
                                            value="Laki-laki"> Laki-laki
                                        <input type="radio" name="jenis_kelamin" id="jenis_kelamin_peremapun"
                                            value="Perempuan"> Perempuan
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nomor_telepon">Nomor Telepon</label>
                                        <input type="text" name="nomor_telepon" id="nomor_telepon"
                                            class="form form-control" placeholder="Nomor Telepon">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="4" class="form form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary btn-md" type="submit"><span
                                            class="fa fa-save"></span> Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <form action="#" id="form-change-email" method="POST">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form form-control">
                                        <small class="text-danger text-xs" id="errEmail"></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm"><span
                                                class="fa fa-save"></span>Perbaharui</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form action="#" method="POST" id="form-change-password">
                                @csrf
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="newpassword">New Password</label>
                                        <input type="password" name="newpassword" id="newpassword" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span>Change Password</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
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
        let path = base.pathname;
        let url = baseUrl + listRoutes['profile.getData'];
        $.getJSON(url, function(res) {}).done(function(res) {
            $('#nip').val(res.data[0].nip)
            $('#nuptk').val(res.data[0].nuptk)
            $('#nama_lengkap').val(res.data[0].nama_lengkap)
            if (res.data[0].jenis_kelamin == 'Laki-laki') {
                $('#jenis_kelamin_laki').prop("checked", true)
            } {
                $('#jenis_kelamin_perempuan').prop("checked", true)
            }
            $('#nomor_telepon').val(res.data[0].notelepon)
            $('#alamat').val(res.data[0].alamat)
            $('#nama').html(res.data[0].nama_lengkap)
            $('#image_user').prop('src', storagePath + '/' + res.data[0].fotos)
            $('#email').val(res.data[0].email)
        }).fail(function(res) {
            alert('Gagal mengambil data')
        })
        $('#form-update-profile').validate({
            rules: {
                'nip': 'required',
                'nuptk': 'required',
                'nama_lengkap': 'required',
                'nomor_telepon': 'required',
                'alamat': 'required',
                'jenis_kelamin': 'required'
            },
            submitHandler: function() {
                var url = baseUrl + listRoutes['profile.update'];
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: "JSON",
                    data: new FormData($('#form-update-profile')[0]),
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        location.reload()
                    },
                    error: function(res) {
                        console.log(res)
                    }
                })
            }

        })
        $('#form-change-email').validate({
            rules: {
                'email': 'required'
            },
            submitHandler: function() {
                let url = baseUrl + listRoutes['profile.changeemail'];
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        email: $('#email').val()
                    },
                    success: function(res) {
                        location.reload()
                    },
                    error: function(res) {
                        if (res.status == 422) {
                            $('#errEmail').html("email sudah dipergunakan")
                        }
                    }
                })
            }
        })

        $('#form-change-password').validate({
            rules: {
                newpassword: {
                    required: true,
                    minlength: 8
                },
                confirmpassword: {
                    required: true,
                    minlength: 8,
                    equalTo: '#newpassword'
                }
            },
            submitHandler: function(){
                var url = baseUrl;
                $.ajax({
                    url: url + listRoutes['profile.ubahpassword'],
                    type: "POST",
                    dataType: "JSON",
                    data: new FormData($('#form-change-password')[0]),
                    processData: false,
                    contentType: false,
                    success: function(res){
                        location.reload()
                    },
                    error: function(res){
                        console.log(res)
                    }
                })
            }
        })
    </script>
@endpush
