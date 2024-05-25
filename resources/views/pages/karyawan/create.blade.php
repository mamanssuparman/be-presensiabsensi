@extends('layouts.master')
@section('title')
    K-BIL | Karyawan
@endsection
@section('content-header')
    <h1>
        Karyawan
        <small>Form Add Karyawan</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Karyawan</li>
        <li>Create</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title">
                </h3>
                <a href="{{ route('karyawan.index') }}" class="btn btn-warning btn-sm pull-right"><span class="fa fa-undo"></span> Kembali</a>
            </div>
            <div class="box-body">
                <form id="form-save-karyawan" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" placeholder="Enter NIP" name="nip">
                            </div>
                            <div class="form-group">
                                <label for="nuptk">NUPTK</label>
                                <input type="text" class="form-control" id="nuptk" placeholder="Enter NUPTK" name="nuptk">
                            </div>
                            <div class="form-group">
                                <label for="nama-lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama-lengkap" placeholder="Enter Nama Lengkap" name="namalengkap">
                            </div>
                            <div class="form-group">
                                <label for="jenis-kelamin">Jenis Kelamin</label> <br>
                                <input type="radio" name="jeniskelamin" id="jenis-kelamin-laki" class="form-check" value="Laki-laki"> Laki-laki
                                <input type="radio" name="jeniskelamin" id="jenis-kelamin-perempuan" class="form-check" value="Perempuan"> Perempuan
                            </div>
                            <div class="form-group">
                                <label for="nomortelepon">Nomor Telepon</label>
                                <input type="text" name="nomortelepon" id="nomortelepon" class="form-control" placeholder="Nomor Telepon">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control"  ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control" >
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" id="email" >
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" name="files" id="" class="">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-save"></span>  Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('externaljs')
<script src="{{ asset('assets/bower_components/jqueryvalidate/jquery.validate.js') }}"></script>
<script type="text/javascript">

    $('#form-save-karyawan').validate({
            rules: {
                'nip' : 'required',
                'nuptk': 'required',
                'namalengkap': 'required',
                'nomortelepon': 'required',
                'alamat': 'required',
                'jabatan': 'required',
                'email': 'required',
                'files': 'required'
            },
            submitHandler: function() {
            let data = new FormData($('#form-save-karyawan')[0]);

                $.ajax({
                    url: window.location.origin+'/karyawan',
                    type: 'POST',
                    data: new FormData($('#form-save-karyawan')[0]),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(res){
                        location.reload()
                    },
                    error: function(res){
                        alert('Gagal menyimpan data')
                    }
            })
            }
        })
</script>
@endpush
